<?php 

namespace App\Repository;

use App\Entity\Chara;


class CharaRepository
{


    /**
     * Méthode permettant de récupérer tous les personnages en base de données et de les
     * renvoyer sous forme de tableau de la classe Chara
     * @return Chara[] la liste des personnages en base de données
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("SELECT * FROM Chara");
        $preparedQuery->execute();

        //foreach($preparedQuery->fetchAll() as $line) {
        while ($line = $preparedQuery->fetch()) {
            $chara = new Chara(
                $line["firstname"],
                $line["lastname"],
                $line["age"],
                $line["picture"],
                $anime,
                $line["id"]
            );
            //Il serait préférable d'appeler une méthode qui fait l'instance pour éviter les répétitions dans les find
            //$chara = $this->lineToChara($line);
            $list[] = $chara;
        }
        return $list;
    }

    /**
     * Méthode qui va récupérer les personnages dont la lastname ou le firstname contiennent
     * le terme donné en argument
     * @param string $keyword Le terme à rechercher dans les personnages
     * @return Chara[] la liste des personnages correspondant à la recherche
     */
    public function search(string $keyword):array {
        $list = [];
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM chara WHERE CONCAT(firstname,lastname) LIKE :keyword");
        $preparedQuery->bindValue(":keyword", "%$keyword%");
        $preparedQuery->execute();

        while($line = $preparedQuery->fetch()) {
            $list[] = $this->lineToChara($line);
        }

        return $list;
    }

    /**
     * Méthode qui va récupérer un personnage par son id dans la base de données
     * @param int $id l'id du personnage à récupérer
     * @return Chara|null Renvoie soit une instance de Chara ou null si aucun personnage ne correspond à l'id donné
     */
    public function findById(int $id): ?Chara {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM chara WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();
        
        $line = $preparedQuery->fetch();
        if ($line) {
            $chara = new Chara(
                $line["firstname"],
                $line["lastname"],
                $line["age"],
                $line["picture"],
                $line["anime"],
                $line["id"]
            );

            //Il serait préférable d'appeler une méthode qui fait l'instance pour éviter les répétitions dans les find
            //$chara = $this->lineToChara($line);
            return $chara;
        }
        return null;
    }

    /**
     * Méthode qui va attendre un objet personnage en argument en entrée et qui l'utilisera
     * pour peupler une requête INSERT INTO et faire persister ce personnage dans la base de 
     * données.
     * @param \App\Entity\Chara $chara Le personnage à faire persister. Une fois le persist fait,
     * le personnage possédera un id autoincrémenté  par MySQL
     */
    public function persist(Chara $chara): void
    {
        $connection = Database::connect();
        
        $preparedQuery = $connection->prepare("INSERT INTO chara (firstname,lastname,age,picture,anime) VALUES (:firstname,:lastname,:age,:picture,:anime)");
        
        $preparedQuery->bindValue(":firstname", $chara->getFirstname());
        $preparedQuery->bindValue(":lastname", $chara->getLastname());
        $preparedQuery->bindValue(":age", $chara->getAge());
        $preparedQuery->bindValue(":picture", $chara->getPicture());
        $preparedQuery->bindValue(":anime", $chara->getAnime());
        
        $preparedQuery->execute();

        //On récupère l'id auto incrémenté par mysql et on l'assigne à notre personnage
        $chara->setId($connection->lastInsertId());
        

    }

    /**
     * Méthode pour supprimer un personnage persisté en base de données en se basant sur
     * son id.
     * @param int $id l'id du personnage à supprimer
     * @return bool Renvoie true si un personnage a bien été supprimé, sinon renvoie false 
     * (dans le cas où aucun personnage ne correspond à l'id)
     */
    public function delete(int $id): bool {
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("DELETE FROM chara WHERE id=:id");
        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();
        
        //Si aucune ligne n'a été affectée par la requête, on renvoie false, sinon true
        return $preparedQuery->rowCount() > 0;
    }

    /**
     * Méthode pour mettre à jour un personnage en base de données
     * @param \App\Entity\Chara $chara une instance de personnage avec un id et des valeurs,
     * de préférence différentes de celles stockées en bdd
     * @return bool True si un personnage a bien été mis à jour, false si non (en gros si on a donné un id qui n'existe pas ou des valeurs similaires à celles en bdd)
     */
    public function update(Chara $chara): bool {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("UPDATE chara SET firstname=:firstname, lastname=:lastname, age=:age, picture=:picture, anime=:anime WHERE id=:id");
        $preparedQuery->bindValue(":firstname", $chara->getFirstname());
        $preparedQuery->bindValue(":lastname", $chara->getLastname());
        $preparedQuery->bindValue(":age", $chara->getAge());
        $preparedQuery->bindValue(":picture", $chara->getPicture());
        $preparedQuery->bindValue(":anime", $chara->getAnime());
        $preparedQuery->bindValue(":id", $chara->getId());
                


        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    /**
     * Méthode qui transforme une ligne de résultat de la base de données en instance de personnage
     * @param array $line La ligne de résultat sous forme de tableau associatif avec les noms de colonnes de la table
     * @return Chara L'instance de personnage correspondant à la ligne de la base de données
     */
    private function lineToChara(array $line):Chara {
        return  new Chara(
                $line["firstname"],
                $line["lastname"],
                $line["age"],
                $line["picture"],
                $line["anime"],
                $line["id"]
            );
}

}



<?php

namespace App\Repository;

use App\Entity\Anime;


class animeRepository
{


    /**
     * Méthode permettant de récupérer tous les animes en base de données et de les
     * renvoyer sous forme de tableau de la classe anime
     * @return anime[] la liste des animes en base de données
     */
    public function findAll(): array
    {
        $list = [];
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("SELECT * FROM anime");
        $preparedQuery->execute();

        //foreach($preparedQuery->fetchAll() as $line) {
        while ($line = $preparedQuery->fetch()) {
            $anime = new anime(
                $line["name"],
                $line["genre"],
                $line["release"],
                $line["image"],
                $line["id"]
            );
            //Il serait préférable d'appeler une méthode qui fait l'instance pour éviter les répétitions dans les find
            //$anime = $this->lineToAnime($line);
            $list[] = $anime;
        }
        return $list;
    }

    /**
     * Méthode qui va récupérer les animes dont la genre ou le name contiennent
     * le terme donné en argument
     * @param string $keyword Le terme à rechercher dans les animes
     * @return anime[] la liste des animes correspondant à la recherche
     */
    public function search(string $keyword):array {
        $list = [];
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM anime WHERE CONCAT(name,genre) LIKE :keyword");
        $preparedQuery->bindValue(":keyword", "%$keyword%");
        $preparedQuery->execute();

        while($line = $preparedQuery->fetch()) {
            $list[] = $this->lineToAnime($line);
        }

        return $list;
    }

    /**
     * Méthode qui va récupérer un chien par son id dans la base de données
     * @param int $id l'id du chien à récupérer
     * @return anime|null Renvoie soit une instance de anime ou null si aucun chien ne correspond à l'id donné
     */
    public function findById(int $id): ?anime {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM anime WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();
        
        $line = $preparedQuery->fetch();
        if ($line) {
            $anime = new anime(
                $line["name"],
                $line["genre"],
                $line["release"],
                $line["image"],
                $line["id"]
            );

            //Il serait préférable d'appeler une méthode qui fait l'instance pour éviter les répétitions dans les find
            //$anime = $this->lineToAnime($line);
            return $anime;
        }
        return null;
    }

    /**
     * Méthode qui va attendre un objet chien en argument en entrée et qui l'utilisera
     * pour peupler une requête INSERT INTO et faire persister ce chien dans la base de 
     * données.
     * @param \App\Entity\anime $anime Le chien à faire persister. Une fois le persist fait,
     * le chien possédera un id autoincrémenté  par MySQL
     */
    public function persist(anime $anime): void
    {
        $connection = Database::connect();
        
        $preparedQuery = $connection->prepare("INSERT INTO anime (name,genre,release,image) VALUES (:name,:genre,:release,:image)");
        
        $preparedQuery->bindValue(":name", $anime->getName());
        $preparedQuery->bindValue(":genre", $anime->getGenre());
        $preparedQuery->bindValue(":release", $anime->getRelease());
        $preparedQuery->bindValue(":image", $anime->getImage());

        
        $preparedQuery->execute();

        //On récupère l'id auto incrémenté par mysql et on l'assigne à notre chien
        $anime->setId($connection->lastInsertId());
        

    }

    /**
     * Méthode pour supprimer un chien persisté en base de données en se basant sur
     * son id.
     * @param int $id l'id du chien à supprimer
     * @return bool Renvoie true si un chien a bien été supprimé, sinon renvoie false 
     * (dans le cas où aucun chien ne correspond à l'id)
     */
    public function delete(int $id): bool {
        $connection = Database::connect();

        $preparedQuery = $connection->prepare("DELETE FROM anime WHERE id=:id");
        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();
        
        //Si aucune ligne n'a été affectée par la requête, on renvoie false, sinon true
        return $preparedQuery->rowCount() > 0;
    }

    /**
     * Méthode pour mettre à jour un chien en base de données
     * @param \App\Entity\anime $anime une instance de chien avec un id et des valeurs,
     * de préférence différentes de celles stockées en bdd
     * @return bool True si un chien a bien été mis à jour, false si non (en gros si on a donné un id qui n'existe pas ou des valeurs similaires à celles en bdd)
     */
    public function update(anime $anime): bool {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("UPDATE anime SET name=:name, genre=:genre, release=:release WHERE id=:id");
        $preparedQuery->bindValue(":name", $anime->getName());
        $preparedQuery->bindValue(":genre", $anime->getGenre());
        $preparedQuery->bindValue(":release", $anime->getRelease());
        $preparedQuery->bindValue(":image", $anime->getImage());

        $preparedQuery->bindValue(":id", $anime->getId());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    /**
     * Méthode qui transforme une ligne de résultat de la base de données en instance de chien
     * @param array $line La ligne de résultat sous forme de tableau associatif avec les noms de colonnes de la table
     * @return anime L'instance de chien correspondant à la ligne de la base de données
     */
    private function lineToAnime(array $line):anime {
        return  new anime(
                $line["name"],
                $line["genre"],
                $line["release"],
                $line["image"],
                $line["id"]
            );
    }
}
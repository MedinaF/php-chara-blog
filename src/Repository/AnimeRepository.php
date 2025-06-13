<?php

namespace App\Repository;

use App\Entity\Anime;


class AnimeRepository
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

        while ($line = $preparedQuery->fetch()) {
            $released = null;
            if (!empty($line["released"])) {
                $released = new \DateTime($line["released"]);
            }
            $anime = new Anime(
                $line["name"],
                $line["genre"],
                $released,
                $line["poster"],
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
     * Méthode qui va récupérer un anime par son id dans la base de données
     * @param int $id l'id du anime à récupérer
     * @return anime|null Renvoie soit une instance de anime ou null si aucun anime ne correspond à l'id donné
     */
    public function findById(int $id): ?anime {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM anime WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();
        
        $line = $preparedQuery->fetch();
        if ($line) {
            $released = null;
            if (!empty($line["released"])) {
                $released = new \DateTime($line["released"]);
            }
            $anime = new Anime(
                $line["name"],
                $line["genre"],
                $released,
                $line["poster"],
                $line["id"]
            );

            //Il serait préférable d'appeler une méthode qui fait l'instance pour éviter les répétitions dans les find
            //$anime = $this->lineToAnime($line);
            return $anime;
        }
        return null;
    }

    /**
     * Méthode qui va attendre un objet anime en argument en entrée et qui l'utilisera
     * pour peupler une requête INSERT INTO et faire persister ce anime dans la base de 
     * données.
     * @param \App\Entity\anime $anime Le anime à faire persister. Une fois le persist fait,
     * le anime possédera un id autoincrémenté  par MySQL
     */
    public function persist(anime $anime): void
    {
        $connection = Database::connect();
        
        $preparedQuery = $connection->prepare("INSERT INTO anime (name,genre,released,poster) VALUES (:name,:genre,:released,:poster)");
        
        $preparedQuery->bindValue(":name", $anime->getName());
        $preparedQuery->bindValue(":genre", $anime->getGenre());
        $preparedQuery->bindValue(":released",$anime->getReleased() ? $anime->getReleased()->format('Y-m-d') : null
        );
        $preparedQuery->bindValue(":poster", $anime->getPoster());

        $preparedQuery->execute();

        $anime->setId($connection->lastInsertId());
        

    }

    /**
     * Méthode pour supprimer un anime persisté en base de données en se basant sur
     * son id.
     * @param int $id l'id du anime à supprimer
     * @return bool Renvoie true si un anime a bien été supprimé, sinon renvoie false 
     * (dans le cas où aucun anime ne correspond à l'id)
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
     * Méthode pour mettre à jour un anime en base de données
     * @param \App\Entity\anime $anime une instance de anime avec un id et des valeurs,
     * de préférence différentes de celles stockées en bdd
     * @return bool True si un anime a bien été mis à jour, false si non (en gros si on a donné un id qui n'existe pas ou des valeurs similaires à celles en bdd)
     */
    public function update(anime $anime): bool {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("UPDATE anime SET name=:name, genre=:genre, released=:released, poster=:poster WHERE id=:id");
        $preparedQuery->bindValue(":name", $anime->getName());
        $preparedQuery->bindValue(":genre", $anime->getGenre());
        $preparedQuery->bindValue(":released",$anime->getReleased() ? $anime->getReleased()->format('Y-m-d') : null);        
        $preparedQuery->bindValue(":poster", $anime->getPoster());

        $preparedQuery->bindValue(":id", $anime->getId());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    /**
     * Méthode qui transforme une ligne de résultat de la base de données en instance de anime
     * @param array $line La ligne de résultat sous forme de tableau associatif avec les noms de colonnes de la table
     * @return anime L'instance de anime correspondant à la ligne de la base de données
     */
    private function lineToAnime(array $line): Anime {
        $released = null;
        if (!empty($line["released"])) {
            $released = new \DateTime($line["released"]);
        }
        return new Anime(
            $line["name"],
            $line["genre"],
            $released,
            $line["poster"],
            $line["id"]
        );
    }

}
<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Chara;

class CommentRepository {

    public function findAll() {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT *,
            chara.id AS chara_id,  
            chara.content AS chara_content,
            chara.date AS chara_date,
            chara.author AS chara_author,
            chara.likes AS chara_likes,
            chara.picture AS chara_picture,
            anime.id AS anime_id,
            chara.id AS chara_id,  
            comment.author AS chara_author,
            comment.content AS comment_content,
            comment.date AS comment_date,
            comment.likes AS comment_likes,
            comment.id AS comment_id
            FROM comment LEFT JOIN chara ON chara.id = comment.charaID");
        $preparedQuery->execute();

        while ($line = $preparedQuery->fetch()) {
            // On récupère l'anime si l'id est défini, sinon on le met à null
            $anime = null;
            if (isset($line["anime_id"])) {
                $animeRepo = new AnimeRepository();
                $anime = $animeRepo->findById($line["anime_id"]);
            }
            $chara = new Chara(
                $line["firstname"],
                $line["lastname"],
                $line["age"],
                $line["picture"],
                $anime,
                $line["id"]
            );
            $comment = new Comment(
                $line["comment_author"],
                $line["comment_content"],
                $line["comment_date"],
                $line["comment_likes"],
                $chara,
                $line["comment_id"]
            );
            $list[]=$comment;
        }
        return $list;
    }
    /**
     * Méthode qui va récupérer tous les commentaires d'un chara, en les triant
     * par date afin de les ordonner du plus récent au plus vieux (pour ensuite les afficher en-dessous de la chara).
     * @param int $id ID de la chara dont on cherche les commentaires
     * @return Comment[] liste triée des commentaires recherchés 
     */
    public function findAllBychara(Chara $chara) {
        $connection = Database::connect();
        $list = [];

        $preparedQuery = $connection->prepare("SELECT * FROM comment WHERE charaID = :charaID ORDER BY date DESC");
        $preparedQuery->bindValue(":charaID", $chara->getId());
        $preparedQuery->execute();

        while($line = $preparedQuery->fetch()) {
            $comment = new Comment(
                $line["author"], 
                $line["content"],
                $line["date"],
                $line["likes"],
                $chara,
                $line["id"]
            );
            $list[]=$comment;
        }
        return $list;
    }
    public function findById(int $id): ?Comment {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("SELECT * FROM comment WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        $line = $preparedQuery->fetch();
        $repo = new CharaRepository;
        if ($line) {
            $comment = new Comment(
                $line["author"],
                $line["content"],
                $line["date"],
                $line["likes"],
                $repo->findById($line["charaID"])
            );
            return $comment;
        }
        return NULL;
    }
    public function persist(Comment $comment) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("INSERT INTO comment (content, date, likes, author, charaID) 
        VALUES (:content, :date, :likes, :author, :charaID)");

        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":author", $comment->getAuthor());
        $preparedQuery->bindValue(":charaID", $comment->getChara()->getId());

        $preparedQuery->execute();

        $comment->setId($connection->lastInsertId());
    }
    public function delete(int $id) {
        $connection = Database::connect();
        $preparedQuery = $connection->prepare("DELETE FROM comment WHERE id=:id");

        $preparedQuery->bindValue(":id", $id);
        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }

    public function update(Comment $comment) {
        $connection = Database::connect();
        $preparedQuery= $connection->prepare("UPDATE comment 
        SET author=:author, content=:content, date=:date, likes=:likes, charaID=:charaID");

        $preparedQuery->bindValue(":author", $comment->getAuthor());
        $preparedQuery->bindValue(":content", $comment->getContent());
        $preparedQuery->bindValue(":date", $comment->getDate());
        $preparedQuery->bindValue(":likes", $comment->getLikes());
        $preparedQuery->bindValue(":charaID", $comment->getChara());

        $preparedQuery->execute();

        return $preparedQuery->rowCount() > 0;
    }
}
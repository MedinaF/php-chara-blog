<?php
 
namespace App\Repository;

/**
 * Classe qui sert à externaliser la connexion à la base de données, on pourra
 * l'appeler dans tous les repositories, plutôt que répéter la connexion
 */
class Database {
    
    /**
     * Méthode pour récupérer une connexion à la base de données. Elle en est static
     *  ce qui signifie qu'on peut appeler cette méthode sans faire d'instance de la
     * classe Database (donc en réalité on pourrait faire juste une fonction sans classe
     * mais c'est histoire de rester sur une approche full objet)
     * @return \PDO La connexion à la base de données
     */
    public static function connect(): \PDO {

        return new \PDO(
            "mysql:host=".$_ENV['DB_HOST'].";port=".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );
    }
}
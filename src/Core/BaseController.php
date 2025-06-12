<?php

namespace App\Core;
/**
 * Le contrôleur de base qui n'est fait que pour être hérité, on n'a pas de raison
 * de l'utiliser tel quel.
 * Il pourrait rendre disponible des méthodes utilitaires partagés par tous les contrôleurs
 * et il fait aussi en sorte de lancer la bonne méthode selon la requête HTTP
 */
class BaseController {
    /**
     * Méthode qui sera lancée par le Router (à priori on aura pas de raison de lancer
     * cette méthode nous même) et qui lance le doGet ou le doPost selon si on est sur
     * une requête http GET ou POST. Et comme doGet et doPost renvoie une BaseView, on
     * lance aussi leur méthode render() automatiquement.
     */
    public function processRequest(): void {
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $this->doGet()->render();
        } else {
            $this->doPost()->render();
        }
    }

    /**
     * Méthode à redéfinir dans les contrôleurs enfants si on veut que le contrôleur
     * gère les requêtes GET
     */
    protected function doGet():BaseView {
        throw new \Exception("Controller does not have a doGet");
    }
    /**
     * Méthode à redéfinir dans les contrôleurs enfants si on veut que le contrôleur
     * puisse process les requêtes POST
     */
    protected function doPost():BaseView {
        throw new \Exception("Controller does not have a doPost");
    }
}
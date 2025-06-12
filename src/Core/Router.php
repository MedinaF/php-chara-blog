<?php

namespace App\Core;

use App\View\ErrorView;

/**
 * Classe qui va se charger de faire le routing, c'est à dire de dispatcher les requêtes
 * HTTP vers le bon contrôleur selon ce qu'il y a dans l'url.
 */
class Router
{
    /**
     * La liste des routes disponible, la clé est l'url et la valeur est le contrôleur lié
     * à cette url
     * @var BaseController[]
     */
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }
    /**
     * Méthode qui va lancer le routing, et qui va récupérer ce qu'il y a dans l'url
     * de la requête, et ensuite boucler sur les routes disponibles pour voir si une
     * des routes match avec l'url. Si oui, alors on lance la méthode du contrôleur
     * lié à ce chemin
     */
    public function init()
    {
        $currentPath = $_SERVER['PATH_INFO'] ?? "";
        foreach ($this->routes as $path => $controller) {
            //On utilise un trim pour retirer les "/" du début et de la fin des chemin pour faire que ça match qu'on ait un slash final ou non
            if (trim($currentPath, "/") == trim($path, "/")) {
                $controller->processRequest();
                return;
            }
        }
        //Si aucune des routes match avec le current path, on affiche une erreur 404
        $errorView = new ErrorView("Page not found : there is no route for $currentPath");
        $errorView->render();
        //Pas obligatoire, mais plus standard, changer le status de la réponse HTTP pour un 404
        http_response_code(404);

    }
}
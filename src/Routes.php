<?php

namespace App;

use App\Controller\AboutController;
use App\Controller\AddCharaController;
use App\Controller\FormController;
use App\Controller\HomeController;
use App\Controller\AnimeController;
use App\Controller\SearchController;
use App\Controller\SingleCharaController;
use App\Controller\UpdateCharaController;


/**
 * Classe qui contient toutes les routes disponibles sur notre application et
 * quel contrôleur est lié à chaque page
 */
class Routes
{
    /**
     * Méthode qui sera appelée dans le index.php pour récupérer la liste des routes à
     * donner à manger au App\Core\Router
     * @return \App\Core\BaseController[]
     */
    public static function defineRoutes()
    {
        return [
            "/" => new HomeController(),
            "/about" => new AboutController(),
            "/example-form" => new FormController(),
            "/anime" =>new AnimeController(),
            "/add-chara" => new AddCharaController(),
            "/chara" => new SingleCharaController(),
            "/search" => new SearchController(),
            "/update-chara" => new UpdateCharaController()
        ];
    }
}
<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\CharaRepository;
use App\View\HomeView;
use App\View\Part\Header;


class HomeController extends BaseController
{

    /**
     * Méthode qui sera appelée pour afficher la page d'accueil
     * @return \App\Core\BaseView
     */

    protected function doGet(): \App\Core\BaseView {
        Header::$pageTitle = "Welcome";
        
        $repo = new CharaRepository();
        $chara = $repo->findAll();
        return new HomeView($chara);

    }
}
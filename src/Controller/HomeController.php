<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\CharaRepository;
use App\View\HomeView;
use App\View\Part\Header;


class HomeController extends BaseController
{


    protected function doGet(): \App\Core\BaseView {
        Header::$pageTitle = "Welcome";
        
        $repo = new CharaRepository();
        return new HomeView($repo->findAll());

    }
}
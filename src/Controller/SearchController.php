<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\CharaRepository;
use App\View\ErrorView;
use App\View\HomeView;
use App\View\Part\Header;

class SearchController extends BaseController {
    protected function doGet(): \App\Core\BaseView {
        Header::$pageTitle = "Search...";
        $keyword = $_GET["keyword"];
        if(empty($keyword)) {
            return new ErrorView("A search keyword is required");
        }

        $repo = new CharaRepository();
        $result = $repo->search($keyword);

        return new HomeView($result);
    }
}
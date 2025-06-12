<?php

namespace App\Controller;

use App\Core\BaseController;
use App\View\AnimeView;
use App\View\RedirectView;

class AnimeController extends BaseController {
    private $names = ["Name 1", "Name 2", "Name 3"];
    protected function doGet(): \App\Core\BaseView {


        return new AnimeView($this->names);
    }

    protected function doPost(): \App\Core\BaseView {
        $this->names[] = $_POST["name"];
        return new RedirectView("/blabla");
    }
}
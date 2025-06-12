<?php

namespace App\Controller;

use App\Core\BaseController;
use App\View\FormView;

class FormController extends BaseController {
    protected function doGet(): \App\Core\BaseView {
        
        return new FormView();
    }
    protected function doPost(): \App\Core\BaseView {
        //récupérer les infos du personnage, le faire persister
        
        return $this->doGet();
    }
}
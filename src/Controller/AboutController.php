<?php

namespace App\Controller;

use App\Core\BaseController;
use App\View\AboutView;

class AboutController extends BaseController{
   protected function doGet(): \App\Core\BaseView {
    return new AboutView();
   }
}
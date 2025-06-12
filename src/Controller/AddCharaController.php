<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Chara;
use App\Repository\CharaRepository;
use App\View\FormCharaView;
use App\View\RedirectView;

class AddCharaController extends BaseController {
    protected function doGet(): \App\Core\BaseView {
        return new FormCharaView();
    }

    protected function doPost(): \App\Core\BaseView {
        if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['age']) && !empty($_POST['picture'])) {
            $repo = new CharaRepository();
            $chara = new Chara($_POST['firstname'], $_POST['lastname'], $_POST['age'], $_POST['picture'], $_GET["anime"]);

            $repo->persist($chara);
            return new RedirectView("/chara?id=".$chara->getId());
        }
        
        return new FormCharaView("firstname, lastname and age are required");
    }
}
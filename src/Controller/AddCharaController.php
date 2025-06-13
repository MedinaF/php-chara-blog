<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Chara;
use App\Repository\CharaRepository;
use App\View\FormCharaView;
use App\View\RedirectView;
use App\Repository\AnimeRepository;

class AddCharaController extends BaseController {
    protected function doGet(): \App\Core\BaseView {
        return new FormCharaView();
    }

protected function doPost(): \App\Core\BaseView {
    if(
        !empty($_POST['firstname']) &&
        !empty($_POST['lastname']) &&
        !empty($_POST['age']) &&
        !empty($_POST["anime"])
    ) {
        $animeRepo = new AnimeRepository();
        $anime = $animeRepo->findById($_POST["anime"]);
        if (!$anime) {
            return new FormCharaView("Anime not found");
        }
        $repo = new CharaRepository();

        // Gestion du fichier image 
        $picture = null;
        if (!empty($_FILES['picture']['name'])) {
            
            $picture = $_FILES['picture']['name'];
        }

        $chara = new Chara(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['age'],
            $anime,
            $picture
        );

        $repo->persist($chara);
        return new RedirectView("/chara?id=".$chara->getId());
    }
    return new FormCharaView("firstname, lastname and age are required");
    }
}
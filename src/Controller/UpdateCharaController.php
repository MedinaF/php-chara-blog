<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Chara;
use App\Repository\CharaRepository;
use App\View\ErrorView;
use App\View\FormCharaView;
use App\View\RedirectView;
use App\Repository\AnimeRepository;


class UpdateCharaController extends BaseController {

    public function doGet(): \App\Core\BaseView {
        $id = $_GET["id"];
        if (!empty($id) && is_numeric($id)) {
            $repo = new CharaRepository();
            $chara = $repo->findById($id);
            if ($chara) {
                return new FormCharaView(chara: $chara);
            }
        }
        return new ErrorView("This chara does not exist");
    }

    public function doPost(): \App\Core\BaseView {
        $repo = new CharaRepository();
        $animeRepo = new AnimeRepository();
        if(empty($_POST["firstname"]) || empty($_POST["lastname"]) || empty($_POST["age"]) || empty($_GET["anime"])) {
            return new FormCharaView(error: "Name, lastname and age are required", chara: $repo->findById($_GET["id"]));
        }
        $anime = $animeRepo->findById($_GET["anime"]);
        if (!$anime) {
            return new FormCharaView(error: "Anime not found", chara: $repo->findById($_GET["id"]));
        }
        $chara = new Chara($_POST["firstname"], $_POST["lastname"], $_POST["age"],$anime, $_POST["picture"] ?? null,  $_GET["id"]);
        $repo->update($chara);
        return new RedirectView("/chara?id=".$chara->getId());
    }
}
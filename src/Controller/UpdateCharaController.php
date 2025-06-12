<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Chara;
use App\Repository\CharaRepository;
use App\View\ErrorView;
use App\View\FormCharaView;
use App\View\RedirectView;

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
        if(empty($_POST["name"]) || empty($_POST["breed"]) || empty($_POST["age"])) {
            return new FormCharaView(error: "Name, breed and age are required", chara: $repo->findById($_GET["id"]));
        }
        $chara = new Chara($_POST["name"], $_POST["breed"], $_POST["age"], $_GET["id"]);
        $repo->update($chara);
        return new RedirectView("/chara?id=".$chara->getId());
    }
}
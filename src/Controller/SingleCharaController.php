<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Entity\Chara;
use App\Repository\CharaRepository;
use App\View\ErrorView;
use App\View\RedirectView;
use App\View\SingleCharaView;

class SingleCharaController extends BaseController
{

    public function doGet(): \App\Core\BaseView
    {
        $id = $_GET["id"];
        if (!empty($id) && is_numeric($id)) {
            $repo = new CharaRepository();
            $chara = $repo->findById($id);
            if ($chara) {
                return new SingleCharaView($chara);
            }
        }
        return new ErrorView("This chara does not exist");

    }

    public function doPost(): \App\Core\BaseView
    {
        $id = $_GET["id"];
        if (!empty($id) && is_numeric($id)) {
            $repo = new CharaRepository();
            if ($repo->delete($id)) {
                return new RedirectView("/");
            }

        }
        return new ErrorView("This chara does not exist");
    }
}
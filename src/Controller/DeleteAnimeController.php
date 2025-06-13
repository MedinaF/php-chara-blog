<?php


namespace App\Controller;

use App\Core\BaseController;
use App\Repository\AnimeRepository;
use App\View\RedirectView;
use App\View\ErrorView;

class DeleteAnimeController extends BaseController {
    protected function doPost(): \App\Core\BaseView {
        if (!empty($_POST["id"])) {
            $repo = new AnimeRepository();
            $repo->delete($_POST["id"]);
            return new RedirectView("/anime");
        }
        return new ErrorView("Anime non trouvé");
    }
}
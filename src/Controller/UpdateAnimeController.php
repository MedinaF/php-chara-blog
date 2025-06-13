<?php

namespace App\Controller;

use App\Core\BaseController;
use App\Repository\AnimeRepository;
use App\View\AnimeView;
use App\View\ErrorView;
use App\View\RedirectView;
use App\Entity\Anime;

class UpdateAnimeController extends BaseController {
    protected function doGet(): \App\Core\BaseView {
        $id = $_GET["id"] ?? null;
        if ($id) {
            $repo = new AnimeRepository();
            $anime = $repo->findById($id);
            if ($anime) {
                // Affiche un formulaire pré-rempli (à créer)
                return new \App\View\FormAnimeView($anime);
            }
        }
        return new ErrorView("Anime not found");
    }

    protected function doPost(): \App\Core\BaseView {
        if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["genre"]) && !empty($_POST["released"])) {
            $repo = new AnimeRepository();
            $released = new \DateTime($_POST["released"]);
            $anime = new Anime(
                $_POST["name"],
                $_POST["genre"],
                $released,
                $_POST["poster"] ?? null,
                $_POST["id"]
            );
            $repo->update($anime);
            return new RedirectView("/anime");
        }
        return new ErrorView("Tous les champs sont requis");
    }
}
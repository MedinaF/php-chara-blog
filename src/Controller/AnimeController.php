<?php

namespace App\Controller;

use App\Core\BaseController;
use App\View\AnimeView;
use App\View\RedirectView;
use App\Repository\AnimeRepository;
use App\Entity\Anime;

class AnimeController extends BaseController {

    protected function doGet(): \App\Core\BaseView {
        $repo = new AnimeRepository();
        $animes = $repo->findAll();
        return new AnimeView($animes);
    }

    protected function doPost(): \App\Core\BaseView {
        if (!empty($_POST["name"]) && !empty($_POST["genre"]) && !empty($_POST["released"])) {
            $repo = new AnimeRepository();
            $released = new \DateTime($_POST["released"]);
            $anime = new Anime(
                $_POST["name"],
                $_POST["genre"],
                $released ?? null,
                $_POST["poster"] ?? null
            );
            $repo->persist($anime);
        }
        return new RedirectView("/anime");
    }
}
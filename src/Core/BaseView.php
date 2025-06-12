<?php

namespace App\Core;

use App\View\Part\Footer;
use App\View\Part\Header;

/**
 * Classe parent dont toutes les Views devront hériter, c'est dans son render qu'on peut
 * indiquer la structure HTML qui sera partagée par toutes nos pages/vues
 * Un enfant de BaseView devra redéfinir la méthode content où on pourra mettre le HTML
 * de la page souhaitée
 */
class BaseView
{

    /**
     * Méthode à redéfinir dans les enfants pour y mettre le HTML de nos pages
     */
    protected function content(): void
    {
        throw new \Exception("Content not defined in the current view");
    }
    /**
     * Méthode qui est appelée automatiquement par le BaseController et dans laquelle on
     * vient indiquer la structure partagée par toutes nos pages. (Si jamais une page
     * ne doit pas avoir la même structure, alors sa View pourra redéfinir la méthode render
     * plutôt que la méthode content)
     * @return void
     */
    public function render(): void
    {

        $header = new Header();
        $footer = new Footer();

        $header->render();
        $this->content();

        $footer->render();
    }
}
<?php

namespace App\View;

use App\Core\BaseView;
use App\View\Part\Header;



class HomeView extends BaseView {
    private array $chara;

    public function __construct(array $chara) {
        $this->chara = $chara;
    }

    protected function content(): void {
        echo "<h1>".Header::$pageTitle."</h1>";
        foreach($this->chara as $chara) {
            echo "<p><a href='/chara?id=".$chara->getId()."'>".$chara->getFirstname()."</a></p>";
        }

    }
}
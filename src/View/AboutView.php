<?php


namespace App\View;

use App\Core\BaseView;

class AboutView extends BaseView {
    protected function content(): void {
        echo "ce site est un projet de test de blog en PHP";
    }
}
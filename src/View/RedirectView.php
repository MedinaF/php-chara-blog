<?php


namespace App\View;

use App\Core\BaseView;

/**
 * Vue permettant de faire des redirection facilement depuis les contrôleurs
 */
class RedirectView extends BaseView {
    /**
     * @param string $redirectLink Le lien vers lequel on souhaite rediriger
     */
    public function __construct(private string $redirectLink) {}

    public function render(): void {
        header("Location: $this->redirectLink");
        exit();
    }
}
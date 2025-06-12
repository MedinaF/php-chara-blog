<?php

namespace App\View;

use App\Core\BaseView;


class ErrorView extends BaseView {
    public function __construct(private string $errorMsg) {}

    protected function content(): void {

        echo "<h1>Oops something went wrong</h1>
        <p>$this->errorMsg</p>";
    }
}
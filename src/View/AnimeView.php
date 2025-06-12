<?php

namespace App\View;

use App\Core\BaseView;

class AnimeView extends BaseView {
    public function __construct(private array $names) {}

    protected function content(): void {
        echo "<ul>";
        foreach ($this->names as $name) {
            echo "<li>$name</li>";
        }
        echo "</ul>";
        ?>
        <form method="post">
            <label>Name
                <input type="text" name="name">
            </label>
            <button>Add anime</button>
        </form>
        <?php
    }

}
<?php

namespace App\View;

use App\Core\BaseView;

class AnimeView extends BaseView {
    public function __construct(private array $animes) {}

    protected function content(): void {
        echo "<ul>";
        foreach ($this->animes as $anime) {
        echo "<li>" . htmlspecialchars($anime->getName()) . " (" . htmlspecialchars($anime->getGenre()) . ") - " . ($anime->getReleased()?->format('Y-m-d') ?? '') .
            // Bouton Update
            ' <a href="/update-anime?id=' . $anime->getId() . '" class="btn-search">Update</a>' .
            // Formulaire Delete
            ' <form method="post" action="/delete-anime" style="display:inline;">
                <input type="hidden" name="id" value="' . $anime->getId() . '">
                <button class="btn-search" onclick="return confirm(\'Supprimer cet anime ?\')">Delete</button>
            </form>' .
            "</li>";
        }
        echo "</ul>";
        ?>
        <form method="post">
            <label>Name
                <input type="text" name="name" required>
            </label>
            <label>Genre
                <input type="text" name="genre" required>
            </label>
            <label>Released (YYYY-MM-DD)
                <input type="date" name="released" required>
            </label>
            <label>Poster (URL)
                <input type="text" name="poster">
            </label>
            <button>Add anime</button>
        </form>
        <?php
    }


    protected function title(): string {
        return "Anime List";
    }
}
<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Anime;

class FormAnimeView extends BaseView {
    public function __construct(private Anime $anime) {}

    protected function content(): void {
        ?>
        <h1>Update Anime</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?= $this->anime->getId() ?>">
            <label>Name
                <input type="text" name="name" value="<?= htmlspecialchars($this->anime->getName()) ?>" required>
            </label>
            <label>Genre
                <input type="text" name="genre" value="<?= htmlspecialchars($this->anime->getGenre()) ?>" required>
            </label>
            <label>Released (YYYY-MM-DD)
                <input type="date" name="released" value="<?= $this->anime->getReleased()?->format('Y-m-d') ?>" required>
            </label>
            <label>Poster (URL)
                <input type="text" name="poster" value="<?= htmlspecialchars($this->anime->getPoster()) ?>">
            </label>
            <button>Update</button>
        </form>
        <?php
    }
}
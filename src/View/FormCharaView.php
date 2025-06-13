<?php


namespace App\View;


use App\Core\BaseView;
use App\Entity\Chara;

class FormCharaView extends BaseView {

    public function __construct(private string $error = "", private ?Chara $chara = null) {
    }
    protected function content(): void {
    // Récupérer la liste des animes pour le select
        $animeRepo = new \App\Repository\AnimeRepository();
        $animes = $animeRepo->findAll();
        ?>
        <h1><?= $this->chara ? "Update":"Add" ?> Chara</h1>
        <form method="post" enctype="multipart/form-data">
            <label>firstname
                <input type="text" name="firstname" value="<?= $this->chara?->getFirstname() ?>">
            </label>
            <label>lastname
                <input type="text" name="lastname" value="<?= $this->chara?->getLastname() ?>">
            </label>
            <label>age
                <input type="number" name="age" value="<?= $this->chara?->getAge() ?>">
            </label>
            <label>picture
                <input type="file" name="picture" accept="image/*">
            </label>
            <label>anime
                <select name="anime" required>
                    <option value="">-- Choisir un anime --</option>
                    <?php foreach($animes as $anime): ?>
                        <option value="<?= $anime->getId() ?>"
                            <?= ($this->chara && $this->chara->getAnime()->getId() == $anime->getId()) ? "selected" : "" ?>>
                            <?= htmlspecialchars($anime->getName()) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button><?= $this->chara ? "Update":"Add" ?></button>
        </form>
        <?php
        if(!empty($this->error)) {
            echo "<p class='error'>$this->error</p>";
        }
    }    

}
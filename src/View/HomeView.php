<?php

namespace App\View;

use App\Core\BaseView;
use App\View\Part\Header;



class HomeView extends BaseView {
    /** @var array */
    protected array $chara = [];

        public function __construct(array $chara) {
        $this->chara = $chara;
    }


    protected function content(): void {
        echo "<h1>".Header::$pageTitle."</h1>";
        echo '<div class="articles-grid">';
        foreach($this->chara as $chara) {
            ?>
            <div class="article-card">
                <div class="article-image">
                    <?php if ($chara->getPicture()): ?>
                        <img src="/public/img/<?= htmlspecialchars($chara->getPicture()) ?>" alt="<?= htmlspecialchars($chara->getFirstname()) ?>" style="width:100%;height:200px;object-fit:cover;">
                    <?php else: ?>
                        <span>?</span>
                    <?php endif; ?>
                </div>
                <div class="article-content">
                    <div class="article-title">
                        <a href="/chara?id=<?= $chara->getId() ?>">
                            <?= htmlspecialchars($chara->getFirstname()) ?> <?= htmlspecialchars($chara->getLastname()) ?>
                        </a>
                    </div>
                    <div class="article-excerpt">
                        Age : <?= htmlspecialchars($chara->getAge()) ?><br>
                        Anime : <?= htmlspecialchars($chara->getAnime()->getName()) ?>
                    </div>
                    <div class="article-meta">
                        <a href="/chara?id=<?= $chara->getId() ?>" class="btn-search">Voir</a>
                    </div>
                </div>
            </div>
            <?php
        }
        echo '</div>';
    }
}
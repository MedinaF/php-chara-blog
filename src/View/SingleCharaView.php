<?php

namespace App\View;

use App\Core\BaseView;
use App\Entity\Chara;

class SingleCharaView extends BaseView
{
    public function __construct(
        private Chara $chara
    ) {
    }

    protected function content(): void
    {
        ?>
        <h1><?= $this->chara->getFirstname() ?></h1>
        <p>Lastname: <?= $this->chara->getLastname() ?></p>
        <p>Age : <?= $this->chara->getAge() ?></p>
        <p>Picture : <?= $this->chara->getPicture() ?></p>
        <form method="post">
            <button>Delete</button>
        </form>
        <a href="/update-chara?id=<?= $this->chara->getId()?>">Update</a>
        <?php
    }
}
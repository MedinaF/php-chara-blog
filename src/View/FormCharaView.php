<?php


namespace App\View;


use App\Core\BaseView;
use App\Entity\Chara;

class FormCharaView extends BaseView {

    public function __construct(private string $error = "", private ?Chara $chara = null) {
    }
    protected function content(): void {
        ?>
        <h1><?= $this->chara ? "Update":"Add" ?> Chara</h1>
        <form method="post">
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
                <input type="number" name="picture" value="<?= $this->chara?->getPicture() ?>">
            </label></button>
            
            <button><?= $this->chara ? "Update":"Add" ?></button>
        </form>
        <?php
        if(!empty($this->error)) {
            echo "<p class='error'>$this->error</p>";
        }
    }    

}
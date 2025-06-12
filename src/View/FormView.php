<?php

namespace App\View;

use App\Core\BaseView;

class FormView extends BaseView
{
    protected function content(): void
    {
        ?>
        <form method="post">
            <label>Test
                <input type="text" name="test">
            </label>
            <button>Lezgo</button>
        </form>

        <?php
    }
}
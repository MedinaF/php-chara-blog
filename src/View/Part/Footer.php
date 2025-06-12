<?php

namespace App\View\Part;
/**
 * Classe utilisée par le BaseView afin d'afficher le footer de la page et la fermeture
 * des balises HTML.
 */
class Footer
{

    /**
     * C'est là qu'on pourra mettre le footer et la fermeture des balises HTML
     * du body
     */
    public function render()
    {
        ?>

            <footer class="footer">
                <p>&copy; 2024 AnimeBlog - Votre passion pour les personnages d'animes</p>
            </footer>
        </body>

        </html>
        <?php
    }
}
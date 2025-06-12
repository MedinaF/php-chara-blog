<?php

namespace App\View\Part;

class Header
{
    /**
     * Titre de la page pour les onglets, modifiable via les controller (ou ailleurs en vrai)
     * en faisant Header::$pageTitle = "titre"
     */
    public static string $pageTitle = "";
    public function render()
    {
        ?>


        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/css/style.css">
            <title>AnimeChara - Retrouvez vos personnages d'animes préférés<?= self::$pageTitle ?></title>
        </head>

        <body>
            <header class="header">
                <div class="nav-container">
                    <div class="logo">🌸 AnimeChara Blog</div>
                        <nav>
                            <ul class="nav-links">
                                <li><a href="/">Home</a></li>
                                <li><a href="/add-chara">Add chara</a></li>
                                <li><a href="/anime">Anime</a></li>
                                <li><a href="/about">About</a></li>
                            </ul>
                        </nav>
                    <form action="/search" method="get">
                        <label>Search :
                            <input type="text" name="keyword">
                        </label>
                        <button class="btn-search">Go</button>
                    </form>
                </div>

            </header>
            <?php
    }
}

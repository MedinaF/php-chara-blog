<?php


use App\Core\Router;
use Dotenv\Dotenv;
use App\Routes;

require __DIR__."/../vendor/autoload.php";

$dotenv = Dotenv::createImmutable('..');
$dotenv->load();

$router = new Router(Routes::defineRoutes());

$router->init();

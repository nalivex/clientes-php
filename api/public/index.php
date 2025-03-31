<?php
require __DIR__ . '/../core/Router.php';
require __DIR__ . '/../core/Database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();

require __DIR__ . '/../../routes.php';

$router->route($uri, $method);
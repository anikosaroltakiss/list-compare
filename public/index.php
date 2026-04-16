<?php

require_once __DIR__ . '/../vendor/autoload.php';

use ListCompare\Infrastructure\Http\Router;
use ListCompare\Infrastructure\TemplateSystem\Renderer;

$renderer = new Renderer(__DIR__ . '/../templates');
$router = new Router($renderer);

$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

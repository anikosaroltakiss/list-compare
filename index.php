<?php

require_once __DIR__ . '/vendor/autoload.php';

use ListCompare\Infrastructure\TemplateSystem\Renderer;

$renderer = new Renderer(__DIR__ . '/templates');

echo $renderer->render('layout.html.twig');

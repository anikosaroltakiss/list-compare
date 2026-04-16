<?php

namespace ListCompare\Infrastructure\TemplateSystem;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer
{

    private Environment $twig;

    /**
     * @param string $templatePath
     */
    public function __construct(string $templatePath)
    {
        $loader = new FilesystemLoader($templatePath);

        $this->twig = new Environment($loader, [
            'debug' => true,
            'cache' => false,
            'strict_variables' => true
        ]);
    }

    /**
     * @param string $name
     * @param array $vars
     * @return string
     */
    public function render(string $name, array $vars = []): string
    {
        return $this->twig->render($name, $vars);
    }
}

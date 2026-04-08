<?php

namespace ListCompare\Infrastructure\Http;

use ListCompare\Infrastructure\TemplateSystem\Renderer;

class Router {
    private Renderer $renderer;

    /**
     * @param Renderer $renderer
     */
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function handleRequest(string $uri, string $method): void
    {
        // Főoldal
        if ($method === 'GET' && ($uri === '/' || $uri === '/index.php')) {
            $this->showHome();
            return;
        }

        // HTMX feldolgozás
        if ($method === 'POST' && $uri === '/compare') {
            $this->handleComparison();
            return;
        }

        // 404 hiba
        $this->notFound();
    }

    /**
     * @return void
     */
    private function showHome(): void
    {
        echo $this->renderer->render('layout.html.twig');
    }

    /**
     * @return void
     */
    private function handleComparison(): void
    {

    }

    /**
     * @return void
     */
    private function notFound(): void
    {
        http_response_code(404);
        echo $this->renderer->render('404.html.twig');
    }
}

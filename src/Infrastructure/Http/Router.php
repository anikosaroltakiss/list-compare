<?php

namespace ListCompare\Infrastructure\Http;

use Exception;
use ListCompare\Domain\ListComparator;
use ListCompare\Domain\SourceType;
use ListCompare\Infrastructure\Provider\ListProviderFactory;
use ListCompare\Infrastructure\TemplateSystem\Renderer;

class Router
{
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
        echo $this->renderer->render('layout.html.twig', ['SourceType' => array_column(SourceType::cases(), 'value', 'name')]);
    }

    /**
     * @return void
     */
    private function handleComparison(): void
    {
        $sourceType = SourceType::tryFrom($_POST['type']);

        if (!$sourceType) {
            header("HX-Retarget: #error-message");
            print "Érvénytelen forrásválasztás! Kérlek, próbáld újra.";
            return;
        }

        try {

            $providers = new ListProviderFactory()->create($sourceType, $_POST, $_FILES);

            $providerA = $providers['A'];
            $providerB = $providers['B'];

            $comparisonResult = new ListComparator()->compare(
                $providerA->getItems(),
                $providerB->getItems()
            );

            echo $this->renderer->render('comparison_results.html.twig', [
                'result' => $comparisonResult
            ]);
            exit;
        } catch (Exception $e) {
            header("HX-Retarget: #error-message");
            echo "Hiba történt a feldolgozás során: " . $e->getMessage();
            exit;
        }



        //var_dump($comparisonResult);
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

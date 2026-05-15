<?php

namespace ListCompare\Infrastructure\Provider;

use ListCompare\Domain\ListProviderInterface;

class TextareaListProvider implements ListProviderInterface
{
    private string $rawText;

    public function __construct(array $postData, string $fieldName)
    {
        $this->rawText = $postData[$fieldName] ?? '';
    }

    public function getItems(): array
    {
        return array_filter(
            array_map('trim', explode("\n", $this->rawText))
        );
    }
}

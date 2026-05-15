<?php

namespace ListCompare\Infrastructure\Provider;

use ListCompare\Domain\ListProviderInterface;
use ListCompare\Domain\SourceType;

class ListProviderFactory
{
    public function create(SourceType $type, array $post, array $files): array
    {
        return match ($type) {
            SourceType::TEXTAREA => [
                'A' => new TextareaListProvider($post, 'list_a'),
                'B' => new TextareaListProvider($post, 'list_b'),
            ],
        };
    }
}

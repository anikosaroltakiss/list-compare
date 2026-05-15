<?php

namespace ListCompare\Application;

use ListCompare\Domain\ComparisonResult;
use ListCompare\Domain\ListComparator;
use ListCompare\Domain\SourceType;
use ListCompare\Infrastructure\Provider\ListProviderFactory;

class ComparisonService
{
    public function __construct(
        private ListProviderFactory $factory,
        private ListComparator $comparator
    ) {}

    public function execute(SourceType $type, array $post, array $files): ComparisonResult
    {
        $providers = $this->factory->create($type, $post, $files);

        return $this->comparator->compare(
            $providers['A']->getItems(),
            $providers['B']->getItems()
        );
    }
}

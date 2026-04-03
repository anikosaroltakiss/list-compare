<?php

namespace ListCompare\Domain;

class ListComparator
{
    /**
     * @param string[] $listA
     * @param string[] $listB
     * @return ComparisonResult
     */
    public function compare(array $listA, array $listB): ComparisonResult
    {
        return new ComparisonResult(
            $this->getOnlyA($listA, $listB),
            $this->getOnlyB($listA, $listB),
            $this->getIntersection($listA, $listB),
            $this->getUnion($listA, $listB)
        );
    }

    /**
     * @param string[] $listA
     * @param string[] $listB
     * @return string[]
     */
    private function getOnlyA(array $listA, array $listB): array
    {
        return array_diff($listA, $listB);
    }

    /**
     * @param string[] $listA
     * @param string[] $listB
     * @return string[]
     */
    private function getOnlyB(array $listA, array $listB): array
    {
        return array_diff($listB, $listA);
    }

    /**
     * @param string[] $listA
     * @param string[] $listB
     * @return string[]
     */
    private function getIntersection(array $listA, array $listB): array
    {
        return array_intersect($listA, $listB);
    }

    /**
     * @param string[] $listA
     * @param string[] $listB
     * @return string[]
     */
    private function getUnion(array $listA, array $listB): array
    {
        return array_unique(array_merge($listA, $listB));
    }
}

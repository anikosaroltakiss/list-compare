<?php

namespace ListCompare\Domain;

class ListComparator {

    /**
     *
     * @param array $listA
     * @param array $listB
     * 
     * @return ComparisonResult
     * 
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
     *
     * @param array $listA
     * @param array $listB
     * 
     * @return array
     * 
     */
    private function getOnlyA(array $listA, array $listB): array
    {
        return array_diff($listA, $listB);
    }

    /**
     *
     * @param array $listA
     * @param array $listB
     * 
     * @return array
     * 
     */
    private function getOnlyB(array $listA, array $listB): array
    {
        return array_diff($listB, $listA);
    }

    /**
     *
     * @param array $listA
     * @param array $listB
     * 
     * @return array
     * 
     */
    private function getIntersection(array $listA, array $listB): array
    {
        return array_intersect($listA, $listB);
    }

    /**
     *
     * @param array $listA
     * @param array $listB
     * 
     * @return array
     * 
     */
    private function getUnion(array $listA, array $listB): array
    {
        return array_unique(array_merge($listA, $listB));
    }
}

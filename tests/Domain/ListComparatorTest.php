<?php

namespace ListCompare\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ListCompare\Domain\ListComparator;

class ListComparatorTest extends TestCase
{
    private ListComparator $comparator;

    protected function setUp(): void
    {
        $this->comparator = new ListComparator();
    }

    /**
     * 1. TESZT: Metszet (Közös elemek) ellenőrzése
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('listResultProvider')]
    public function test_it_calculates_correct_intersection(
        array $listA,
        array $listB,
        array $expectedUniqueA,
        array $expectedUniqueB,
        array $expectedIntersect,
        array $expectedUnion
    ): void {
        $result = $this->comparator->compare($listA, $listB);

        // Érték és sorrend ellenőrzése (fontos, hogy indexelve legyenek a tömbök a kényelemért)
        $this->assertEquals(array_values($expectedIntersect), array_values($result->intersection));
    }

    /**
     * 2. TESZT: Csak az A listában meglévő elemek ellenőrzése
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('listResultProvider')]
    public function test_it_calculates_correct_elements_unique_to_list_a(
        array $listA,
        array $listB,
        array $expectedUniqueA,
        array $expectedUniqueB,
        array $expectedIntersect,
        array $expectedUnion
    ): void {
        $result = $this->comparator->compare($listA, $listB);

        $this->assertEquals(array_values($expectedUniqueA), array_values($result->onlyA));
    }

    /**
     * 3. TESZT: Csak a B listában meglévő elemek ellenőrzése
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('listResultProvider')]
    public function test_it_calculates_correct_elements_unique_to_list_b(
        array $listA,
        array $listB,
        array $expectedUniqueA,
        array $expectedUniqueB,
        array $expectedIntersect,
        array $expectedUnion
    ): void {
        $result = $this->comparator->compare($listA, $listB);

        $this->assertEquals(array_values($expectedUniqueB), array_values($result->onlyB));
    }

    /**
     * 4. TESZT: Az Unió (Összes egyedi elem) ellenőrzése
     */
    #[\PHPUnit\Framework\Attributes\DataProvider('listResultProvider')]
    public function test_it_calculates_correct_union(
        array $listA,
        array $listB,
        array $expectedUniqueA,
        array $expectedUniqueB,
        array $expectedIntersect,
        array $expectedUnion
    ): void {
        $result = $this->comparator->compare($listA, $listB);

        $this->assertEquals(array_values($expectedUnion), array_values($result->union));
    }

    /**
     * DATA PROVIDER: A tesztadatok gyűjtőhelye (Scenarios)
     */
    public static function listResultProvider(): array
    {
        return [
            'alapeset átfedéssel (happy path)' => [
                'listA'             => ['alma', 'körte'],
                'listB'             => ['körte', 'barack'],
                'expectedUniqueA'   => ['alma'],
                'expectedUniqueB'   => ['barack'],
                'expectedIntersect' => ['körte'],
                'expectedUnion'     => ['alma', 'körte', 'barack'],
            ],
            'teljesen azonos listák' => [
                'listA'             => ['alma', 'körte'],
                'listB'             => ['alma', 'körte'],
                'expectedUniqueA'   => [],
                'expectedUniqueB'   => [],
                'expectedIntersect' => ['alma', 'körte'],
                'expectedUnion'     => ['alma', 'körte'],
            ],
            'teljesen különböző listák' => [
                'listA'             => ['alma', 'körte'],
                'listB'             => ['barack', 'szilva'],
                'expectedUniqueA'   => ['alma', 'körte'],
                'expectedUniqueB'   => ['barack', 'szilva'],
                'expectedIntersect' => [],
                'expectedUnion'     => ['alma', 'körte', 'barack', 'szilva'],
            ],
            'az egyik lista teljesen üres' => [
                'listA'             => ['alma', 'körte'],
                'listB'             => [],
                'expectedUniqueA'   => ['alma', 'körte'],
                'expectedUniqueB'   => [],
                'expectedIntersect' => [],
                'expectedUnion'     => ['alma', 'körte'],
            ],
            'mindkét lista üres' => [
                'listA'             => [],
                'listB'             => [],
                'expectedUniqueA'   => [],
                'expectedUniqueB'   => [],
                'expectedIntersect' => [],
                'expectedUnion'     => [],
            ],
            'duplikált elemek a bemeneten' => [
                'listA'             => ['alma', 'alma', 'körte'],
                'listB'             => ['körte', 'körte', 'barack'],
                'expectedUniqueA'   => ['alma'],
                'expectedUniqueB'   => ['barack'],
                'expectedIntersect' => ['körte'],
                'expectedUnion'     => ['alma', 'körte', 'barack'],
            ],
            'kis- és nagybetű érzékenység ellenőrzése' => [
                'listA'             => ['alma'],
                'listB'             => ['Alma'],
                'expectedUniqueA'   => ['alma'],
                'expectedUniqueB'   => ['Alma'],
                'expectedIntersect' => [],
                'expectedUnion'     => ['alma', 'Alma'],
            ],
        ];
    }
}

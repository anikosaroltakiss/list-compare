<?php

namespace ListCompare\Domain;

readonly class ComparisonResult
{

  public readonly int $countA;
  public readonly int $countB;
  public readonly int $intersectCount;
  public readonly int $unionCount;
  /**
   * @param string[] $onlyA
   * @param string[] $onlyB
   * @param string[] $intersection
   * @param string[] $union
   */
  public function __construct(
    public readonly array $sourceA,
    public readonly array $sourceB,
    public array $onlyA,
    public array $onlyB,
    public array $intersection,
    public array $union
  ) {
    $this->countA = count($onlyA) + count($intersection); // Vagy a nyers A hossza
    $this->countB = count($onlyB) + count($intersection);
    $this->intersectCount = count($intersection);
    $this->unionCount = count($union);
  }
}

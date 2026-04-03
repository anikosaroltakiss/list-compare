<?php

namespace ListCompare\Domain;

readonly class ComparisonResult
{

  /**
   * @param string[] $onlyA
   * @param string[] $onlyB
   * @param string[] $intersection
   * @param string[] $union
   */
  public function __construct(
    public array $onlyA,
    public array $onlyB,
    public array $intersection,
    public array $union
  ) {}
}

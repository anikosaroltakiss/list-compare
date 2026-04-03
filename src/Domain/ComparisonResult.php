<?php 

namespace ListCompare\Domain;

readonly class ComparisonResult {

  public function __construct (
    /** @var string[] */
    public array $onlyA,
    /** @var string[] */
    public array $onlyB,
    /** @var string[] */
    public array $intersection,
    /** @var string[] */
    public array $union
  )
  {
    
  }
}

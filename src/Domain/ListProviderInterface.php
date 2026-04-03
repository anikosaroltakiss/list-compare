<?php 

namespace ListCompare\Domain;

interface ListProviderInterface {
  /**
    * @return string[]
  */
  public function getItems(): array;
}

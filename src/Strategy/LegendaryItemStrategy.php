<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Model\Item\Item;

class LegendaryItemStrategy implements UpdateItemStrategyInterface
{
    public function apply(Item $item): void
    {
        // do nothing
    }
}

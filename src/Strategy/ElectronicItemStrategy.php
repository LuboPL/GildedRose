<?php
declare(strict_types=1);
// this is strategy class with new item category
namespace App\Strategy;

use App\Model\Item\Item;

class ElectronicItemStrategy implements UpdateItemStrategyInterface
{
    public function apply(Item $item): void
    {
        // implement logic
    }
}

<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;

interface UpdateItemStrategyInterface
{
    /**
     * @throws GildedRoseLogicException
     */
    public function apply(Item $item): void;
}

<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;

class RegularItemStrategy implements UpdateItemStrategyInterface
{
    /**
     * @throws GildedRoseLogicException
     */
    public function apply(Item $item): void
    {
        $item->decreaseOneDaySellInn();
        $item->isExpired() ? $item->decreaseQuality(2) : $item->decreaseQuality(1);
        if ($item->getQuality() < 0) {
            $item->setQuality(0);
            throw new GildedRoseLogicException('Quality cannot be negative');
        }
    }
}

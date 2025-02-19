<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;

class CheeseItemStrategy implements UpdateItemStrategyInterface
{
    /**
     * @throws GildedRoseLogicException
     */
    public function apply(Item $item): void
    {
        $item->decreaseOneDaySellInn();
        if ($item->getQuality() <= 50) {
            $increaseQuality = $item->getSellIn() > 0 ? 1 : 2;

            if ($item->getQuality() + $increaseQuality > 50) {
                $item->setQuality(50);
                throw new GildedRoseLogicException('Quality cannot be bigger than 50');
            }
            $item->increaseQuality($increaseQuality) ;
        }
    }
}

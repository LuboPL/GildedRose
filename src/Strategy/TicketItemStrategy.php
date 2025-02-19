<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;

class TicketStrategy implements UpdateItemStrategyInterface
{
    /**
     * @throws GildedRoseLogicException
     */
    public function apply(Item $item): void
    {
        if ($item->getSellIn() >= 0) {
            $increase = match (true) {
                $item->getSellIn() >= 10 => 1,
                $item->getSellIn() > 5 => 2,
                default => 3,
            };

            if ($item->getSellIn() < 0) {
                $item->setQuality(0);
                return;
            }

            if ($item->getQuality() + $increase > 50) {
                throw new GildedRoseLogicException('Quality cannot be bigger than 50');
            }

            $this->quality += $increase;
        }
    }
}

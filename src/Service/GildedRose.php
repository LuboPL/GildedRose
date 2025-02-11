<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\GildedRoseLogicException;
use App\Model\Item;

class GildedRose
{
    public function updateQuality(Item $item): void
    {
        try {
            if (false === $item->hasExpirationDate()) {
                return;
            }

            if ($item->hasMaxQuality()) {
                return;
            }

            if (false === $item->raisesQuality()) {
                $item->decreaseQuality();
            }

            $item->increaseQuality();
            $item->decreaseSellInn();

            if ($item->isExpired()) {
                $item->markNoQuality();
            }
        } catch (GildedRoseLogicException $exception) {
            // place to log here
        }
    }
}

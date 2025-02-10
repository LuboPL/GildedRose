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
            if (false === $item->hasMaxQuality()) {
                $item->decreaseSellInn();

                if (false === $item->raisesQuality()) {
                    $item->decreaseQuality();
                }
                $item->increaseQuality();

                if ($item->isExpired()) {
                    $item->markNoQuality();
                }
            }
        } catch (GildedRoseLogicException $exception) {
        }
    }
}

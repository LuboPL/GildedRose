<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\ItemBehaviourInterface;

class GildedRose
{
    public function updateQuality(ItemBehaviourInterface $item): void
    {
        try {
            $item->decreaseSellInn();
            $item->decreaseQuality();
            $item->increaseQuality();
        } catch (GildedRoseLogicException $exception) {
            // place to log here
        }
    }
}

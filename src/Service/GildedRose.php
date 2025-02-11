<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\ItemBehaviourInterface;

class GildedRose
{
    public function updateItem(ItemBehaviourInterface $item): void
    {
        try {
            $item->decreaseSellInn();
            $item->updateQuality();
        } catch (GildedRoseLogicException $exception) {
            // place to log here
        }
    }
}

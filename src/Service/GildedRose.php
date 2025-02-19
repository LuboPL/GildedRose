<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;

class GildedRose
{
    public function updateItem(Item $item): void
    {
        try {
            $item->updateItemByStrategy();
        } catch (GildedRoseLogicException $exception) {
            // place to log here
        }
    }
}

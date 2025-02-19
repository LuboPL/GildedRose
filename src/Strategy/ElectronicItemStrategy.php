<?php
declare(strict_types=1);
// this is example class with new item category
namespace App\Strategy;

use App\Model\Item\AbstractItem;

class Electronic extends AbstractItem
{
    public function updateQuality(): void
    {
    }

    public function decreaseSellInn(): void
    {
    }
}

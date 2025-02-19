<?php
declare(strict_types=1);

namespace App\Strategy;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\AbstractItem;

class Regular extends AbstractItem
{
    /**
     * @throws GildedRoseLogicException
     */
    public function updateQuality(): void
    {
        $this->isExpired() ? $this->quality -= 2 : $this->quality--;
        if ($this->quality < 0) {
            $this->quality = 0;
            throw new GildedRoseLogicException('Quality cannot be negative');
        }
    }
}

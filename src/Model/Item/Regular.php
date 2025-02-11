<?php
declare(strict_types=1);

namespace App\Model\Item;

use App\Exception\GildedRoseLogicException;

class Regular extends AbstractItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
        protected int $sellIn,
        protected int $quality
    )
    {
    }

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

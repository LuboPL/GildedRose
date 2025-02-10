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

    public function hasExpirationDate(): bool
    {
        return true;
    }

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function increaseQuality(): void
    {
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function decreaseQuality(): void
    {
        $this->isExpired() ? $this->quality -= 2 : $this->quality--;
        if ($this->quality < 0) {
            $this->quality = 0;
            throw new GildedRoseLogicException('Quality cannot be negative');
        }
    }
}

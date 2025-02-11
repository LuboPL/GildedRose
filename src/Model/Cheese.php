<?php
declare(strict_types=1);

namespace App\Model;

use App\Exception\GildedRoseLogicException;

class Cheese extends AbstractItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
        protected int $sellIn,
        protected int $quality
    )
    {
    }

    public function raisesQuality(): bool
    {
        return true;
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function increaseQuality(): void
    {
        if ($this->raisesQuality() && $this->quality <= 50) {
            $increaseQuality = $this->sellIn > 0 ? 1 : 2;

            if ($this->quality + $increaseQuality > 50) {
                $this->quality = 50;
                throw new GildedRoseLogicException('Quality cannot be bigger than 50');
            }
            $this->quality += $increaseQuality;
        }

    }

    public function hasExpirationDate(): bool
    {
        return true;
    }

    public function decreaseQuality(): void
    {
    }
}

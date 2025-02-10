<?php
declare(strict_types=1);

namespace App\Model\Item;

use App\Exception\GildedRoseLogicException;

class Ticket extends AbstractItem
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
        if (!$this->raisesQuality() || $this->sellIn <= 0) {
            return;
        }

        $increase = match (true) {
            $this->sellIn >= 10 => 1,
            $this->sellIn > 5 => 2,
            default => 3,
        };

        if ($this->quality + $increase > 50) {
            throw new GildedRoseLogicException('Quality cannot be bigger than 50');
        }

        $this->quality += $increase;
    }

    public function hasExpirationDate(): bool
    {
        return true;
    }

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function decreaseQuality(): void
    {
        if ($this->isExpired()) {
            $this->markNoQuality();
        }
    }
}

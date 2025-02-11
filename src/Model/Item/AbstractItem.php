<?php
declare(strict_types=1);

namespace App\Model\Item;

use App\Exception\GildedRoseLogicException;

abstract class AbstractItem implements ItemBehaviourInterface
{
    protected int $quality;
    protected int $sellIn;

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function raisesQuality(): bool
    {
        return false;
    }

    public function hasMaxQuality(): bool
    {
        return false;
    }

    public function isExpired(): bool
    {
        return false;
    }
    public function markNoQuality(): void
    {
        $this->quality = 0;
    }

    public function hasExpirationDate(): bool
    {
        return false;
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function increaseQuality(): void
    {
        $this->quality++;
        if ($this->quality > 50) {
            throw new GildedRoseLogicException('Quality cannot be bigger than 50');
        }
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function decreaseQuality(): void
    {
        $this->quality--;
        if ($this->quality < 0) {
            throw new GildedRoseLogicException('Quality cannot be negative');
        }
    }

    public function decreaseSellInn(): void
    {
        $this->sellIn--;
    }
}

<?php
declare(strict_types=1);

namespace App\Model\Item;

use App\Exception\GildedRoseLogicException;
use App\Strategy\UpdateItemStrategyInterface;

final class Item
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
        private readonly UpdateItemStrategyInterface $updateItemStrategy,
        private int $sellIn,
        private int $quality
    )
    {
    }

    public function getSellIn(): int
    {
        return $this->sellIn;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function setQuality(int $quality): void
    {
        $this->quality = $quality;
    }

    public function increaseQuality($increaseQuality): void
    {
        $this->quality += $increaseQuality;
    }

    public function decreaseQuality($decreaseQuality): void
    {
        $this->quality -= $decreaseQuality;
    }

    public function decreaseOneDaySellInn(): void
    {
        $this->sellIn--;
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function updateItemByStrategy(): void
    {
        $this->updateItemStrategy->apply($this);
    }
}

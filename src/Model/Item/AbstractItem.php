<?php
declare(strict_types=1);

namespace App\Model\Item;

abstract class AbstractItem implements ItemBehaviourInterface
{
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

    public function isExpired(): bool
    {
        return $this->sellIn < 0;
    }

    public function decreaseSellInn(): void
    {
        $this->sellIn--;
    }
}

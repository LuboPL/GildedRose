<?php
declare(strict_types=1);

namespace App\Model;

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

    public function increaseQuality(): void
    {
        $this->quality++;
    }

    public function decreaseQuality(): void
    {
        $this->quality--;
    }

    public function decreaseSellInn(): void
    {
        $this->sellIn--;
    }
}

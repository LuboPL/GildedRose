<?php
declare(strict_types=1);

namespace App\Model;

class Legendary extends AbstractItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
        protected int $sellIn,
        protected int $quality
    )
    {
    }

    public function hasMaxQuality(): bool
    {
        return true;
    }

    public function increaseQuality(): void
    {
    }

    public function decreaseQuality(): void
    {
    }

    public function decreaseSellInn(): void
    {
    }
}

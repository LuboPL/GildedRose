<?php
declare(strict_types=1);

namespace App\Model\Item;

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

    public function updateQuality(): void
    {
    }

    public function decreaseSellInn(): void
    {
    }
}

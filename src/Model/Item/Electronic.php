<?php
declare(strict_types=1);
// this is example class with new item category
namespace App\Model\Item;

class Electronic extends AbstractItem
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
        protected int $sellIn,
        protected int $quality
    )
    {
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

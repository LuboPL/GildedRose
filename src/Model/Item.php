<?php
declare(strict_types=1);

namespace App\Model;

use App\Enum\ItemType;
use App\Exception\GildedRoseLogicException;

final class Item implements ItemBehaviourInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $itemType,
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

    public function raisesQuality(): bool
    {
        return in_array(
            $this->itemType,
            [
                ItemType::CHEESE->value,
                ItemType::TICKET->value
            ]
        );
    }

    public function markNoQuality(): void
    {
        $this->quality = 0;
    }

    public function hasMaxQuality(): bool
    {
        return $this->quality === 80;
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function increaseQuality(): void
    {
        if ($this->quality < 50) {
            $this->updateQualityBasedOnItemType();
        }

        if ($this->quality > 50) {
            throw new GildedRoseLogicException('Quality cannot be bigger than 50');
        }
//        if ($this->quality < 50) {
//            if ($this->itemType === ItemType::CHEESE->value) {
//                $this->quality++;
//                if ($this->sellIn <= 0 && $this->quality < 50) {
//                    $this->quality++;
//                }
//            }
//
//            if ($this->itemType === ItemType::TICKET->value) {
//                if ($this->sellIn >= 10) {
//                    $this->quality++;
//                }
//                if ($this->sellIn < 10 && $this->sellIn > 5) {
//                    $this->quality = $this->quality + 2;
//                }
//                if ($this->sellIn <= 5) {
//                    $this->quality = $this->quality + 3;
//                }
//            }
//        }
//
//        if ($this->quality > 50) {
//            throw new GildedRoseLogicException('Quality cannot be bigger than 50');
//        }
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function decreaseQuality(): void
    {
        if ($this->itemType === ItemType::ELIXIR->value && $this->sellIn < 0) {
            $this->quality = $this->quality - 2;
        }

        if ($this->itemType === ItemType::ELIXIR->value && $this->sellIn > 0) {
            $this->quality--;
        }

        if ($this->quality < 0) {
            throw new GildedRoseLogicException('Quality cannot be negative');
        }
    }

    public function decreaseSellInn(): void
    {
        $this->sellIn--;
    }

    public function isExpired(): bool
    {
        return match ($this->itemType) {
            ItemType::TICKET->value => $this->sellIn < 0,
            default => false,
        };
    }

    private function updateQualityBasedOnItemType(): void
    {
        switch ($this->itemType) {
            case ItemType::CHEESE->value:
                $this->updateCheeseQuality();
                break;
            case ItemType::TICKET->value:
                $this->updateTicketQuality();
                break;
        }
    }

    private function updateCheeseQuality(): void
    {
        $this->quality++;
        if ($this->sellIn <= 0 && $this->quality < 50) {
            $this->quality++;
        }
    }

    private function updateTicketQuality(): void
    {
        $increase = match (true) {
            $this->sellIn >= 10 => 1,
            $this->sellIn >= 5 => 2,
            default => 3
        };

        $this->quality += $increase;
    }
}

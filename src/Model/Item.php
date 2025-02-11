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

    public function hasExpirationDate(): bool
    {
        return match ($this->itemType) {
            ItemType::ELECTRONIC->value => false,
            default => true,
        };
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function increaseQuality(): void
    {
        if ($this->quality < 50) {
            $this->updateQualityBasedOnItemType();
        }
    }

    /**
     * @throws GildedRoseLogicException
     */
    public function decreaseQuality(): void
    {
        $decrease = $this->sellIn > 0 ? 1 : 2;

        if ($this->quality - $decrease < 0) {
            throw new GildedRoseLogicException('Quality cannot be negative');
        }

        $this->quality -= $decrease;
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

    /**
     * @throws GildedRoseLogicException
     */
    private function updateQualityBasedOnItemType(): void
    {
        switch ($this->itemType) {
            case ItemType::CHEESE->value:
                $this->quality++;
                if ($this->sellIn <= 0 && $this->quality < 50) {
                    $this->quality++;
                }
                if ($this->quality > 50) {
                    $this->quality = 50;
                    throw new GildedRoseLogicException('Quality cannot be bigger than 50');
                }
                break;

            case ItemType::TICKET->value:
                if ($this->sellIn >= 0) {
                    $increase = ($this->sellIn > 10) ? 1 : (($this->sellIn > 5) ? 2 : 3);
                    if ($increase + $this->quality > 50) {
                        throw new GildedRoseLogicException('Quality cannot be bigger than 50');
                    }
                    $this->quality += $increase;
                }
                break;
        }
    }
}

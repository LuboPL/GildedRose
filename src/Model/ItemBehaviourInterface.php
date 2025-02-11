<?php
declare(strict_types=1);

namespace App\Model;

use App\Exception\GildedRoseLogicException;

interface ItemBehaviourInterface
{
    public function raisesQuality(): bool;
    public function hasMaxQuality(): bool;
    public function hasExpirationDate(): bool;
    public function isExpired(): bool;
    /**
     * @throws GildedRoseLogicException
     */
    public function increaseQuality(): void;
    /**
     * @throws GildedRoseLogicException
     */
    public function decreaseQuality(): void;
    public function decreaseSellInn(): void;
    public function markNoQuality(): void;
}

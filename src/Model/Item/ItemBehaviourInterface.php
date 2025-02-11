<?php
declare(strict_types=1);

namespace App\Model\Item;

use App\Exception\GildedRoseLogicException;

interface ItemBehaviourInterface
{
    public function raisesQuality(): bool;
    public function isExpired(): bool;
    /**
     * @throws GildedRoseLogicException
     */
    public function updateQuality(): void;
    public function decreaseSellInn(): void;
}

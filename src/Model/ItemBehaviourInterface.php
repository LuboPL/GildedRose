<?php
declare(strict_types=1);

namespace App\Model;

interface ItemBehaviourInterface
{
    public function raisesQuality(): bool;
    public function hasMaxQuality(): bool;
    public function hasExpirationDate(): bool;
    public function isExpired(): bool;
    public function increaseQuality(): void;
    public function decreaseQuality(): void;
    public function decreaseSellInn(): void;
    public function markNoQuality(): void;
}

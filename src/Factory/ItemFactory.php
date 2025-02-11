<?php
declare(strict_types=1);

namespace App\Factory;

use App\Enum\ItemType;
use App\Model\Cheese;
use App\Model\Electronic;
use App\Model\ItemBehaviourInterface;
use App\Model\Legendary;
use App\Model\Regular;
use App\Model\Ticket;

class ItemFactory
{
    public static function create(string $name, string $type, int $sellIn, int $quality): ItemBehaviourInterface
    {
        return match ($type) {
            ItemType::TICKET->value => new Ticket($name, $type, $sellIn, $quality),
            ItemType::CHEESE->value => new Cheese($name, $type, $sellIn, $quality),
            ItemType::LEGENDARY->value => new Legendary($name, $type, $sellIn, $quality),
            ItemType::ELECTRONIC->value => new Electronic($name, $type, $sellIn, $quality),
            default => new Regular($name, $type, $sellIn, $quality),
        };
    }
}

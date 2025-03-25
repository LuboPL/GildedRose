<?php
declare(strict_types=1);

namespace App\Strategy\Factory;

use App\Enum\ItemType;
use App\Strategy\CheeseItemStrategy;
use App\Strategy\ElectronicItemStrategy;
use App\Strategy\LegendaryItemStrategy;
use App\Strategy\RegularItemStrategy;
use App\Strategy\TicketItemStrategy;
use App\Strategy\UpdateItemStrategyInterface;

class UpdateStrategyFactory
{
    public function create(string $type): UpdateItemStrategyInterface
    {
        return match ($type) {
            ItemType::TICKET->value => new TicketItemStrategy(),
            ItemType::CHEESE->value => new CheeseItemStrategy(),
            ItemType::LEGENDARY->value => new LegendaryItemStrategy(),
            ItemType::ELECTRONIC->value => new ElectronicItemStrategy(),
            ItemType::REGULAR->value => new RegularItemStrategy(),
            default => throw new \RuntimeException(sprintf('Unknown item type: %s', $type)),
        };
    }
}

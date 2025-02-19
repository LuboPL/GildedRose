<?php
declare(strict_types=1);

namespace Tests;

use App\Exception\GildedRoseLogicException;
use App\Model\Item\Item;
use App\Strategy\Factory\UpdateStrategyFactory;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private readonly UpdateStrategyFactory $strategyFactory;

    public function setUp(): void
    {
        $this->strategyFactory = new UpdateStrategyFactory();
    }

    public function testItemOverQualityException(): void
    {
        $this->expectException(GildedRoseLogicException::class);

        $strategy = $this->strategyFactory->create('cheese');
        $item = new Item('parmegiano', 'cheese', $strategy, -1, 49);
        $item->updateItemByStrategy();

        $this->expectExceptionMessage('Quality cannot be bigger than 50');
    }

    public function testItemNegativeQualityException(): void
    {
        $this->expectException(GildedRoseLogicException::class);

        $strategy = $this->strategyFactory->create('regular');
        $item = new Item('water', 'regular', $strategy, 0, 1);
        $item->updateItemByStrategy();

        $this->expectExceptionMessage('Quality cannot be negative');
    }
}

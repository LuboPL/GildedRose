<?php
declare(strict_types=1);

namespace Tests;

use App\Exception\GildedRoseLogicException;
use App\Factory\ItemFactory;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    private readonly ItemFactory $itemFactory;

    public function setUp(): void
    {
        $this->itemFactory = new ItemFactory();
    }

    public function testItemOverQualityException(): void
    {
        $this->expectException(GildedRoseLogicException::class);

        $item = $this->itemFactory->create('Parmegiano', 'cheese', -1, 49);
        $item->updateQuality();

        $this->expectExceptionMessage('Quality cannot be bigger than 50');
    }

    public function testItemNegativeQualityException(): void
    {
        $this->expectException(GildedRoseLogicException::class);

        $item = $this->itemFactory->create('Water', 'regular', -1, 1);
        $item->updateQuality();

        $this->expectExceptionMessage('Quality cannot be negative');
    }
}

<?php
declare(strict_types=1);

namespace Tests;

use App\Model\Item\Item;
use App\Service\GildedRose;
use App\Strategy\Factory\UpdateStrategyFactory;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    private readonly GildedRose $gildedRose;
    private readonly UpdateStrategyFactory $strategyFactory;

    public function setUp(): void
    {
        $this->gildedRose = new GildedRose();
        $this->strategyFactory = new UpdateStrategyFactory();
    }

    /**
     * @dataProvider itemsProvider
     */
    public function testUpdateItem(
        string $name,
        int $sellIn,
        int $quality,
        int $expectedSellIn,
        int $expectedQuality
    ): void
    {
        $type = $this->getItemTypeByName($name);

        $strategy = $this->strategyFactory->create($type);

        $item = new Item($name, $type, $strategy, $sellIn, $quality);

        $this->gildedRose->updateItem($item);

        $this->assertEquals($expectedSellIn, $item->getSellIn());
        $this->assertEquals($expectedQuality, $item->getQuality());
    }

    public function itemsProvider(): array
    {
        return [
            'Aged Brie before sell in date' => ['Aged Brie', 10, 10, 9, 11],
            'Aged Brie sell in date' => ['Aged Brie', 0, 10, -1, 12],
            'Aged Brie after sell in date' => ['Aged Brie', -5, 10, -6, 12],
            'Aged Brie before sell in date with maximum quality' => ['Aged Brie', 5, 50, 4, 50],
            'Aged Brie sell in date near maximum quality' => ['Aged Brie', 0, 49, -1, 50],
            'Aged Brie sell in date with maximum quality' => ['Aged Brie', 0, 50, -1, 50],
            'Aged Brie after_sell in date with maximum quality' => ['Aged Brie', -10, 50, -11, 50],
            'Backstage passes before sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 10, 10, 9, 12],
            'Backstage passes more than 10 days before sell in date' =>
                ['Backstage passes to a TAFKAL80ETC concert', 11, 10, 10, 11],
            'Backstage passes five days before sell in date' =>
                ['Backstage passes to a TAFKAL80ETC concert', 5, 10, 4, 13],
            'Backstage passes sell in date' => ['Backstage passes to a TAFKAL80ETC concert', 0, 10, -1, 0],
            'Backstage passes close to sell in date with maximum quality' =>
                ['Backstage passes to a TAFKAL80ETC concert', 10, 50, 9, 50],
            'Backstage passes very close to sell in date with maximum quality' =>
                ['Backstage passes to a TAFKAL80ETC concert', 5, 50, 4, 50],
            'Backstage passes after sell in date' => ['Backstage passes to a TAFKAL80ETC concert', -5, 50, -6, 0],
            'Sulfuras before sell in date' => ['Sulfuras, Hand of Ragnaros', 10, 80, 10, 80],
            'Sulfuras sell in date' => ['Sulfuras, Hand of Ragnaros', 0, 80, 0, 80],
            'Sulfuras after sell in date' => ['Sulfuras, Hand of Ragnaros', -1, 80, -1, 80],
            'Elixir of the Mongoose before sell in date' => ['Elixir of the Mongoose', 10, 10, 9, 9],
            'Elixir of the Mongoose sell in date' => ['Elixir of the Mongoose', 0, 10, -1, 8],
            'Elixir of the Mongoose after sell in date' => ['Elixir of the Mongoose', -1, 8, -2, 6],
            'Old portable computer' => ['Portable computer', 0, 49, 0, 49],
        ];
    }

    // using as in memory repository
    private function getItemTypeByName(string $name): string
    {
        $itemsByTypes = [
            'legendary' => ['Sulfuras, Hand of Ragnaros'],
            'cheese' => ['Aged Brie'],
            'ticket' => ['Backstage passes to a TAFKAL80ETC concert'],
            'regular' => ['Elixir of the Mongoose'],
            'electronic' => ['Portable computer'],
        ];

        foreach ($itemsByTypes as $type => $itemName) {
            if (in_array($name, $itemName)) {
                return $type;
            }
        }

        throw new \RuntimeException(sprintf('Not found type, for product name: %s', $name));
    }
}

<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\Enum\ItemEnum;
use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testRegularItem(): void
    {
        $items = [new Item('Regular Item', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('Regular Item', $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrie(): void
    {
        $items = [new Item(ItemEnum::AGED_BRIE->value, 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(ItemEnum::AGED_BRIE->value, $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(1, $items[0]->quality);
    }

    public function testBackstagePasses(): void
    {
        $items = [new Item(ItemEnum::BACKSTAGE_PASSES->value, 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(ItemEnum::BACKSTAGE_PASSES->value, $items[0]->name);
        $this->assertSame(-1, $items[0]->sellIn);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testSulfuras(): void
    {
        $items = [new Item(ItemEnum::SULFURAS->value, 0, 80)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame(ItemEnum::SULFURAS->value, $items[0]->name);
        $this->assertSame(0, $items[0]->sellIn);
        $this->assertSame(80, $items[0]->quality);
    }
}

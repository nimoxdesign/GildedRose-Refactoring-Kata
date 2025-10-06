<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater;

use GildedRose\Item;
use GildedRose\Strategy\Updater\Concerns\InteractsWithQuality;
use GildedRose\Strategy\Updater\Concerns\InteractsWithSellIn;

abstract class BaseItemUpdater
{
    use InteractsWithQuality;
    use InteractsWithSellIn;

    public function __construct(
        protected Item $item
    ) {
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}

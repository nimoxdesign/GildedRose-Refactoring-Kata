<?php

declare(strict_types=1);

namespace GildedRose;

use GildedRose\Enum\ItemEnum;
use GildedRose\Strategy\Updater\AgedBrieUpdater;
use GildedRose\Strategy\Updater\BackstagePassesUpdater;
use GildedRose\Strategy\Updater\ConjuredUpdater;
use GildedRose\Strategy\Updater\ItemUpdater;
use GildedRose\Strategy\Updater\SulfurasUpdater;

final class GildedRose
{
    /**
     * @param Item[] $items
     */
    public function __construct(
        private array $items
    ) {
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function updateQuality(): self
    {
        foreach ($this->items as $item) {
            $updater = match ($item->name) {
                ItemEnum::AGED_BRIE->value => new AgedBrieUpdater($item),
                ItemEnum::BACKSTAGE_PASSES->value => new BackstagePassesUpdater($item),
                ItemEnum::CONJURED->value => new ConjuredUpdater($item),
                ItemEnum::SULFURAS->value => new SulfurasUpdater($item),
                default => new ItemUpdater($item),
            };

            $updater->updateSellIn();
            $updater->updateQuality();
        }

        return $this;
    }
}

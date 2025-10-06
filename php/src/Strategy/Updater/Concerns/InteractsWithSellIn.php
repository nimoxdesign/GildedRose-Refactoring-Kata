<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater\Concerns;

use GildedRose\Item;

trait InteractsWithSellIn
{
    abstract public function getItem(): Item;

    public function updateSellIn(): void
    {
        if (! $this->canUpdateSellIn()) {
            return;
        }

        $this->getItem()->sellIn--;
    }

    protected function canUpdateSellIn(): bool
    {
        return true;
    }
}

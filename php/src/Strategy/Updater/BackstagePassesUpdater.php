<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater;

final class BackstagePassesUpdater extends BaseItemUpdater
{
    protected function updateExpiredQuality(): void
    {
        $this->resetQuality();
    }

    protected function updateNonExpiredQuality(): void
    {
        $sellIn = $this->getItem()->sellIn;

        // x3 if < 5 days left, x2 if < 10 days left, x1 as default
        $increment = $sellIn <= 5
            ? 3
            : (
                $sellIn <= 10
                    ? 2
                    : 1
            );

        $this->increaseQuality($increment);
    }
}

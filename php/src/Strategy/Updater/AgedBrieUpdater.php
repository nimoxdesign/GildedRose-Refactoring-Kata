<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater;

final class AgedBrieUpdater extends BaseItemUpdater
{
    protected function updateExpiredQuality(): void
    {
        $this->increaseQuality();
    }

    protected function updateNonExpiredQuality(): void
    {
        $this->increaseQuality();
    }
}

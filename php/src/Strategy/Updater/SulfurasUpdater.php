<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater;

final class SulfurasUpdater extends BaseItemUpdater
{
    protected function canUpdateSellIn(): bool
    {
        return false;
    }

    protected function canUpdateQuality(): bool
    {
        return false;
    }
}

<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater;

final class ConjuredUpdater extends BaseItemUpdater
{
    protected function decreaseQuality(int $decrement = self::QUALITY_DECREMENT): void
    {
        $this->getItem()->quality = max(
            self::MIN_QUALITY,
            $this->getItem()->quality - $decrement * 2
        );
    }
}

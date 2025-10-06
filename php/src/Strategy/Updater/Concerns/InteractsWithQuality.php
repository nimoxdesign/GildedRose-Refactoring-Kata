<?php

declare(strict_types=1);

namespace GildedRose\Strategy\Updater\Concerns;

use GildedRose\Item;

trait InteractsWithQuality
{
    public const MIN_QUALITY = 0;

    public const MAX_QUALITY = 50;

    public const QUALITY_DECREMENT = 1;

    public const QUALITY_INCREMENT = 1;

    abstract public function getItem(): Item;

    public function updateQuality(): void
    {
        if (! $this->canUpdateQuality()) {
            return;
        }

        $this->getItem()->sellIn < 0
            ? $this->updateExpiredQuality()
            : $this->updateNonExpiredQuality();
    }

    protected function canUpdateQuality(): bool
    {
        return true;
    }

    protected function updateExpiredQuality(): void
    {
        $this->decreaseQuality(2);
    }

    protected function updateNonExpiredQuality(): void
    {
        $this->decreaseQuality();
    }

    protected function increaseQuality(int $increment = self::QUALITY_INCREMENT): void
    {
        $this->getItem()->quality = min(
            self::MAX_QUALITY,
            $this->getItem()->quality + $increment
        );
    }

    protected function decreaseQuality(int $decrement = self::QUALITY_DECREMENT): void
    {
        $this->getItem()->quality = max(
            self::MIN_QUALITY,
            $this->getItem()->quality - $decrement
        );
    }

    protected function resetQuality(): void
    {
        $this->getItem()->quality = self::MIN_QUALITY;
    }
}

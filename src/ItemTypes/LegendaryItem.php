<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class LegendaryItem extends BaseItem implements ItemInterface
{
    public function __construct(string $name, int $quality, int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);

        // Legendary items never degrade
        $this->itemQuality = 80;
    }

    protected function updateLifespan()
    {
    }

    protected function updateQuality()
    {
    }
}

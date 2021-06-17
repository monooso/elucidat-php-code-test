<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class WellAgedItem extends BaseItem implements ItemInterface
{
    protected function updateQuality()
    {
        $change = $this->itemLifespan > 0 ? 1 : 2;
        $this->itemQuality = min(50, $this->itemQuality + $change);
    }
}

<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class ConjuredItem extends BaseItem implements ItemInterface
{
    protected function updateQuality()
    {
        $change = $this->itemLifespan >= 0 ? 2 : 4;

        $this->itemQuality = $this->normalizeQuality($this->itemQuality - $change);
    }
}

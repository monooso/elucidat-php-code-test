<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class SimpleItem extends BaseItem implements ItemInterface
{
    protected function updateQuality()
    {
        if ($this->itemQuality === 0) {
            return;
        }

        $this->itemQuality -= ($this->itemLifespan >= 0 ? 1 : 2);
    }
}

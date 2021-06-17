<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class SimpleItem extends BaseItem implements ItemInterface
{
    public function nextDay(): ItemInterface
    {
        $this->updateQuality();

        return $this;
    }

    /**
     * Update the item quality in response to a passing day
     */
    private function updateQuality()
    {
        if ($this->itemQuality === 0) {
            return;
        }

        $this->itemQuality -= ($this->itemLifespan >= 0 ? 1 : 2);
    }
}

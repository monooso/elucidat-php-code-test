<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class SimpleItem extends BaseItem implements ItemInterface
{
    public function nextDay(): ItemInterface
    {
        // Note the order; it's important
        $this->updateLifespan();
        $this->updateQuality();

        return $this;
    }

    /**
     * Update the item lifespan in response to a passing day
     */
    private function updateLifespan()
    {
        $this->itemLifespan -= 1;
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

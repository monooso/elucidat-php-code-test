<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class EventItem extends BaseItem implements ItemInterface
{
    protected function updateQuality()
    {
        $lifespan = $this->itemLifespan;
        $quality = $this->itemQuality;

        // Event items have no value once the event has passed
        if ($lifespan < 0) {
            $this->itemQuality = 0;
            return;
        }

        $change = match(true) {
            $lifespan > 10 => 1,
            $lifespan > 5 => 2,
            default => 3,
        };

        $this->itemQuality = min(50, $quality + $change);
    }
}

<?php

declare(strict_types=1);

namespace App\Traits;

trait HasItemLifespan
{
    /**
     * The number of days until the item's "sell-by" date
     *
     * @var int $itemLifespan
     */
    protected int $itemLifespan;

    /**
     * Get the number of days until the item "sell-by" date
     *
     * @return int
     */
    public function getSellIn(): int
    {
        return $this->itemLifespan;
    }
}

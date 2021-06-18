<?php

declare(strict_types=1);

namespace App\Traits;

trait HasItemQuality
{
    /**
     * The item quality score
     *
     * @var int $itemQuality
     */
    protected int $itemQuality;

    /**
     * Get the item quality score
     *
     * @return int
     */
    public function getQuality(): int
    {
        return $this->itemQuality;
    }
}

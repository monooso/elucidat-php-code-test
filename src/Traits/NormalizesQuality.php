<?php

declare(strict_types=1);

namespace App\Traits;

trait NormalizesQuality
{
    /**
     * Ensure the quality score falls within the given range
     *
     * @param int $quality
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    protected function normalizeQuality(int $quality, int $min, int $max): int
    {
        return max($min, min($max, $quality));
    }
}

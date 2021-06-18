<?php

declare(strict_types=1);

namespace App\Traits;

trait HasDecreasingLifespan
{
    /**
     * Decrement the given lifespan
     *
     * @param int $lifespan
     *
     * @return int
     */
    protected function updateLifespan(int $lifespan): int
    {
        return $lifespan - 1;
    }
}

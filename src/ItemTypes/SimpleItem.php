<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Contracts\ItemInterface;
use App\Traits\HasDecreasingLifespan;

final class SimpleItem extends BaseItem implements ItemInterface
{
    use HasDecreasingLifespan;

    protected function calculateQuality(int $quality, int $lifespan): int
    {
        $quality -= ($lifespan < 0 ? 2 : 1);

        return $this->normalizeQuality($quality, self::MIN_QUALITY, self::MAX_QUALITY);
    }
}

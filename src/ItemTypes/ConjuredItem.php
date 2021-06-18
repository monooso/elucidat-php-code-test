<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Contracts\ItemInterface;
use App\Traits\HasDecreasingLifespan;
use App\Traits\NormalizesQuality;

final class ConjuredItem extends BaseItem implements ItemInterface
{
    use HasDecreasingLifespan;
    use NormalizesQuality;

    protected function calculateQuality(int $quality, int $lifespan): int
    {
        $quality -= ($lifespan < 0 ? 4 : 2);

        return $this->normalizeQuality($quality, self::MIN_QUALITY, self::MAX_QUALITY);
    }
}

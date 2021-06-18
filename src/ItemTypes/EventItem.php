<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Contracts\ItemInterface;

final class EventItem extends BaseItem implements ItemInterface
{
    protected function calculateQuality(int $quality, int $lifespan): int
    {
        $quality = match (true) {
            $lifespan > 10 => $quality + 1,
            $lifespan > 5  => $quality + 2,
            $lifespan >=0  => $quality + 3,
            default        => self::MIN_QUALITY,    // No value after event
        };

        return $this->normalizeQuality($quality, self::MIN_QUALITY, self::MAX_QUALITY);
    }
}

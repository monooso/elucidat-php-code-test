<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Contracts\ItemInterface;
use App\Traits\HasDecreasingLifespan;
use App\Traits\HasItemLifespan;
use App\Traits\HasItemName;
use App\Traits\HasItemQuality;
use App\Traits\HasMagicAccessors;
use App\Traits\NormalizesQuality;

abstract class BaseItem implements ItemInterface
{
    use HasDecreasingLifespan;
    use HasItemLifespan;
    use HasItemName;
    use HasItemQuality;
    use HasMagicAccessors;
    use NormalizesQuality;

    protected const MIN_QUALITY = 0;
    protected const MAX_QUALITY = 50;

    /**
     * Construct a new item
     *
     * @param string $name
     * @param int    $quality
     * @param int    $sellIn
     */
    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->itemName = $name;
        $this->itemQuality = $this->normalizeQuality($quality, static::MIN_QUALITY, static::MAX_QUALITY);
        $this->itemLifespan = $sellIn;
    }

    public function nextDay(): ItemInterface
    {
        $lifespan = $this->itemLifespan;
        $quality = $this->itemQuality;

        // Order is important
        $lifespan = $this->updateLifespan($lifespan);
        $quality = $this->calculateQuality($quality, $lifespan);

        $this->itemLifespan = $lifespan;
        $this->itemQuality = $quality;

        return $this;
    }

    /**
     * Calculate the new item quality
     *
     * @param int $quality
     * @param int $lifespan
     *
     * @return int
     */
    abstract protected function calculateQuality(int $quality, int $lifespan): int;
}

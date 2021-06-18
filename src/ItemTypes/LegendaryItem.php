<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Contracts\ItemInterface;
use App\Traits\HasItemLifespan;
use App\Traits\HasItemName;
use App\Traits\HasItemQuality;
use App\Traits\HasMagicAccessors;

final class LegendaryItem implements ItemInterface
{
    use HasItemLifespan;
    use HasItemName;
    use HasItemQuality;
    use HasMagicAccessors;

    /**
     * Construct a new legendary item
     *
     * The initial quality is ignored; legendary items always have a quality of 80.
     *
     * @param string $name
     * @param int    $quality
     * @param int    $sellIn
     */
    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->itemName = $name;
        $this->itemQuality = 80;
        $this->itemLifespan = $sellIn;
    }

    /**
     * Legendary items are immutable
     *
     * @return ItemInterface
     */
    public function nextDay(): ItemInterface
    {
        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\ItemTypes;

use App\Exceptions\UnknownPropertyException;

abstract class BaseItem implements ItemInterface
{
    /**
     * The item name
     *
     * @var string $itemName
     */
    protected string $itemName;

    /**
     * The item quality score
     *
     * @var int $itemQuality
     */
    protected int $itemQuality;

    /**
     * The number of days until the item's "sell-by" date
     *
     * @var int $itemLifespan
     */
    protected int $itemLifespan;

    /**
     * Construct a new item
     *
     * @todo validate the given quality and sell-in properties
     *
     * @param string $name
     * @param int    $quality
     * @param int    $sellIn
     */
    public function __construct(string $name, int $quality, int $sellIn)
    {
        $this->itemName = $name;
        $this->itemQuality = $quality;
        $this->itemLifespan = $sellIn;
    }

    /**
     * Provide property-style access to the protected class attributes
     *
     * Mostly a convenience layer, to preserve compatibility with existing code.
     *
     * @param string $name
     *
     * @return int|string
     */
    public function __get(string $name): int | string
    {
        $method = 'get' . ucfirst($name);

        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new UnknownPropertyException("Unknown property $name");
    }

    public function getName(): string
    {
        return $this->itemName;
    }

    public function getQuality(): int
    {
        return $this->itemQuality;
    }

    public function getSellIn(): int
    {
        return $this->itemLifespan;
    }

    public function nextDay(): static
    {
        // Note the order; it's important
        $this->updateLifespan();
        $this->updateQuality();

        return $this;
    }

    /**
     * Update the item lifespan in response to a passing day
     */
    protected function updateLifespan()
    {
        $this->itemLifespan -= 1;
    }

    /**
     * Update the item quality in response to a passing day
     */
    abstract protected function updateQuality();
}

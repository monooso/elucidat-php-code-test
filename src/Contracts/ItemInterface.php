<?php

declare(strict_types=1);

namespace App\Contracts;

interface ItemInterface
{
    /**
     * Update the item quality and sell-in properties
     *
     * Should be called once per day.
     *
     * @return $this
     */
    public function nextDay(): self;

    /**
     * Get the item name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the item quality score
     *
     * @return int
     */
    public function getQuality(): int;

    /**
     * Get the number of days until the item "sell-by" date
     *
     * @return int
     */
    public function getSellIn(): int;
}

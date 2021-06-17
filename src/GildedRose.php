<?php

declare(strict_types=1);

namespace App;

class GildedRose
{
    public function __construct(private array $items)
    {}

    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    public function nextDay()
    {
        foreach ($this->items as $item) {
            $item->nextDay();
        }
    }
}

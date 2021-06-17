<?php

declare(strict_types=1);

namespace App;

use App\ItemTypes\ItemInterface;

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
            if ($item instanceof ItemInterface) {
                $item->nextDay();
                continue;
            }

            if ($item->name != 'Aged Brie') {
                if ($item->quality > 0) {
                    $item->quality = $item->quality - 1;
                }
            } else {
                if ($item->quality < 50) {
                    $item->quality = $item->quality + 1;
                }
            }

            $item->sellIn = $item->sellIn - 1;

            if ($item->sellIn < 0) {
                if ($item->name != 'Aged Brie') {
                    if ($item->quality > 0) {
                        $item->quality = $item->quality - 1;
                    }
                } else {
                    if ($item->quality < 50) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}

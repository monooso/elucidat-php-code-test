<?php

declare(strict_types=1);

namespace App;

use App\ItemTypes\ItemInterface;
use OutOfBoundsException;

final class GildedRose
{
    /**
     * The array of items to process
     *
     * @var ItemInterface[]
     */
    private array $items;

    /**
     * Constructor
     *
     * @param ItemInterface[] $items
     */
    public function __construct(array $items)
    {
        $this->items = [];

        foreach ($items as $item) {
            $this->addItem($item);
        }
    }

    /**
     * Add an item to the items array
     *
     * Allow type-hint errors to bubble.
     *
     * @param ItemInterface $item
     *
     * @return void
     */
    private function addItem(ItemInterface $item): void
    {
        $this->items[] = $item;
    }

    /**
     * Get the item at the given array index
     *
     * @param int|null $index
     *
     * @return ItemInterface|array
     */
    public function getItem(int $index = null): ItemInterface | array
    {
        if (is_null($index)) {
            // Log a simple deprecation notice
            error_log('[DEPRECATED] Calling getItem without a key is deprecated. Use getAllItems instead.');
            return $this->getAllItems();
        }

        if ($index < 0 || $index >= count($this->items)) {
            throw new OutOfBoundsException("There is no item with an array key of $index");
        }

        return $this->items[$index];
    }

    /**
     * Get all of the items
     *
     * @return ItemInterface[]
     */
    public function getAllItems(): array
    {
        return $this->items;
    }

    /**
     * Update the items by advancing to the next day
     */
    public function nextDay()
    {
        foreach ($this->items as $item) {
            $item->nextDay();
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Traits;

trait HasItemName
{
    /**
     * The item name
     *
     * @var string $itemName
     */
    protected string $itemName;

    /**
     * Get the item name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->itemName;
    }
}

<?php

declare(strict_types=1);

namespace App\ItemTypes;

final class SimpleItem extends BaseItem implements ItemInterface
{
    public function nextDay(): ItemInterface
    {
        return $this;
    }
}

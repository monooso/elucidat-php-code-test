<?php

declare(strict_types=1);

namespace App\Traits;

use App\Exceptions\UnknownPropertyException;

trait HasMagicAccessors
{
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
}

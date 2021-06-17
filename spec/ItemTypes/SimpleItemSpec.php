<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\Exceptions\UnknownPropertyException;
use App\ItemTypes\SimpleItem;
use Faker\Factory;

describe('SimpleItem', function () {
    describe('property accessor methods', function () {
        // We could move this to beforeEach, but `use` is a bit clearer.
        $faker = Factory::create();
        $name = $faker->name();
        $quality = $faker->numberBetween(1, 50);
        $sellIn = $faker->numberBetween(1, 50);
        $item = new SimpleItem($name, $quality, $sellIn);

        it('returns the item name', function () use ($item, $name) {
            expect($item->getName())->toBe($name);
        });

        it('returns the item quality', function () use ($item, $quality) {
            expect($item->getQuality())->toBe($quality);
        });

        it('returns the item sell-in', function () use ($item, $sellIn) {
            expect($item->getSellIn())->toBe($sellIn);
        });
    });

    describe('magic properties', function () {
        $faker = Factory::create();
        $name = $faker->name();
        $quality = $faker->numberBetween(1, 50);
        $sellIn = $faker->numberBetween(1, 50);
        $item = new SimpleItem($name, $quality, $sellIn);

        it('returns the item name', function () use ($item, $name) {
            expect($item->name)->toBe($name);
        });

        it('returns the item quality', function () use ($item, $quality) {
            expect($item->quality)->toBe($quality);
        });

        it('returns the item sell-in', function () use ($item, $sellIn) {
            expect($item->sellIn)->toBe($sellIn);
        });

        it('throws an exception for unknown properties', function () use ($item) {
            $closure = fn() => $item->wibble;
            expect($closure)->toThrow(new UnknownPropertyException());
        });
    });
});

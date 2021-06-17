<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\Exceptions\UnknownPropertyException;
use App\ItemTypes\SimpleItem;
use Faker\Factory;

describe('SimpleItem', function () {
    describe('initial quality', function () {
        it('changes an initial quality greater than 50 to 50', function () {
            $item = new SimpleItem('x', 51, 10);
            expect($item->getQuality())->toBe(50);
        });

        it('changes an initial quality less than 0 to 0', function () {
            $item = new SimpleItem('x', -1, 10);
            expect($item->getQuality())->toBe(0);
        });
    });

    describe('nextDay', function () {
        describe('degrading quality', function () {
            it('reduces the quality by 1 unit per day', function () {
                $quality = 20;
                $item = new SimpleItem('x', $quality, 100);

                for ($count = 1; $count < 5; $count++) {
                    expect($item->nextDay()->getQuality())->toBe($quality - $count);
                }
            });

            it('reduces the quality by 2 units per day after the sell-by date', function () {
                $quality = 20;
                $item = new SimpleItem('x', $quality, -1);

                for ($count = 2; $count < 10; $count += 2) {
                    expect($item->nextDay()->getQuality())->toBe($quality - $count);
                }
            });

            it('never reduces the quality below zero', function () {
                $item = new SimpleItem('x', 1, 10);

                $item->nextDay()->nextDay();

                expect($item->getQuality())->toBe(0);
            });
        });

        describe('reducing lifespan', function () {
            it('reduces the lifespan by 1 unit per day', function () {
                $sellIn = 20;
                $item = new SimpleItem('x', 100, $sellIn);

                for ($count = 1; $count < 5; $count++) {
                    expect($item->nextDay()->getSellIn())->toBe($sellIn - $count);
                }
            });
        });
    });

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
            $closure = fn () => $item->wibble;
            expect($closure)->toThrow(new UnknownPropertyException());
        });
    });
});

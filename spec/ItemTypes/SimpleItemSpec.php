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

    describe('instance properties', function () {
        beforeEach(function () {
            $faker = Factory::create();

            $this->name = $faker->name();
            $this->quality = $faker->numberBetween(1, 50);
            $this->sellIn = $faker->numberBetween(1, 50);

            $this->item = new SimpleItem($this->name, $this->quality, $this->sellIn);
        });

        it('it supports property accessor methods', function () {
            expect($this->item->getName())->toBe($this->name);
            expect($this->item->getQuality())->toBe($this->quality);
            expect($this->item->getSellIn())->toBe($this->sellIn);
        });

        it('supports magic accessors', function () {
            expect($this->item->name)->toBe($this->name);
            expect($this->item->quality)->toBe($this->quality);
            expect($this->item->sellIn)->toBe($this->sellIn);
        });

        it('throws an exception for unknown properties', function () {
            $closure = fn () => $this->item->wibble;
            expect($closure)->toThrow(new UnknownPropertyException());
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
});

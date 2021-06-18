<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\Exceptions\UnknownPropertyException;
use App\ItemTypes\EventItem;
use App\Traits\HasMagicAccessors;
use Faker\Factory;

describe('EventItem', function () {
    describe('initial quality', function () {
        it('changes an initial quality greater than 50 to 50', function () {
            $item = new EventItem('x', 51, 10);
            expect($item->getQuality())->toBe(50);
        });

        it('changes an initial quality less than 0 to 0', function () {
            $item = new EventItem('x', -1, 10);
            expect($item->getQuality())->toBe(0);
        });
    });

    describe('nextDay', function () {
        describe('increasing quality', function () {
            it('increases the quality by 1 when the lifespan is more than 10', function () {
                $item = new EventItem('x', 0, 12);
                expect($item->nextDay()->getQuality())->toBe(1);
            });

            it('increases the quality by 2 when the lifespan is greater than 5 and less than 11', function () {
                $item = new EventItem('x', 0, 11);
                expect($item->nextDay()->getQuality())->toBe(2);

                $item = new EventItem('x', 0, 7);
                expect($item->nextDay()->getQuality())->toBe(2);
            });

            it('increases the quality by 3 when the lifespan is greater than -1 and less than 6', function () {
                $item = new EventItem('x', 0, 6);
                expect($item->nextDay()->getQuality())->toBe(3);

                $item = new EventItem('x', 0, 1);
                expect($item->nextDay()->getQuality())->toBe(3);
            });

            it('sets the quality to zero when the lifespan is less than zero', function () {
                $item = new EventItem('x', 10, 0);
                expect($item->nextDay()->getQuality())->toBe(0);
            });

            it('does not increase the item quality beyond the maximum of 50', function () {
                $item = new EventItem('x', 50, 10);
                expect($item->nextDay()->getQuality())->toBe(50);
            });
        });
    });
});

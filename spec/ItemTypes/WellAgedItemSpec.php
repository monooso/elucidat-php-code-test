<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\ItemTypes\WellAgedItem;

describe('WellAgedItem', function () {
    describe('nextDay', function () {
        describe('increasing quality', function () {
            it('increases the quality by 1 when the lifespan is more than 0', function () {
                $item = new WellAgedItem('x', 0, 2);
                expect($item->nextDay()->getQuality())->toBe(1);
            });

            it('increases the quality by 2 when the lifespan is zero', function () {
                $item = new WellAgedItem('x', 0, 1);
                expect($item->nextDay()->getQuality())->toBe(2);
            });

            it('increases the quality by 2 when the lifespan is less than zero', function () {
                $item = new WellAgedItem('x', 0, 0);
                expect($item->nextDay()->getQuality())->toBe(2);
            });

            it('does not increase the item quality beyond the maximum of 50', function () {
                $item = new WellAgedItem('x', 50, 10);
                expect($item->nextDay()->getQuality())->toBe(50);

                $item = new WellAgedItem('x', 49, -10);
                expect($item->nextDay()->getQuality())->toBe(50);
            });
        });
    });
});

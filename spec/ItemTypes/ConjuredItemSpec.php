<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\ItemTypes\ConjuredItem;

describe('ConjuredItem', function () {
    describe('initial quality', function () {
        it('changes an initial quality greater than 50 to 50', function () {
            $item = new ConjuredItem('x', 51, 10);
            expect($item->getQuality())->toBe(50);
        });

        it('changes an initial quality less than 0 to 0', function () {
            $item = new ConjuredItem('x', -1, 10);
            expect($item->getQuality())->toBe(0);
        });
    });

    describe('nextDay', function () {
        describe('degrading quality', function () {
            it('reduces the quality by 2 units per day', function () {
                $item = new ConjuredItem('x', 20, 100);
                expect($item->nextDay()->getQuality())->toBe(18);
            });

            it('reduces the quality by 4 units per day after the sell-by date', function () {
                $item = new ConjuredItem('x', 10, -1);
                expect($item->nextDay()->getQuality())->toBe(6);
            });

            it('never reduces the quality below zero', function () {
                $item = new ConjuredItem('x', 0, 10);
                expect($item->nextDay()->getQuality())->toBe(0);
            });
        });
    });
});

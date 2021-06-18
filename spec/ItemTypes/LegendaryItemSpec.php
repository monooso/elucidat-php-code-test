<?php

declare(strict_types=1);

namespace Specs\ItemTypes;

use App\ItemTypes\LegendaryItem;

describe('LegendaryItem', function () {
    describe('initial quality', function () {
        it('changes an initial quality to 80', function () {
            $item = new LegendaryItem('x', 10, 10);
            expect($item->getQuality())->toBe(80);
        });
    });

    describe('nextDay', function () {
        describe('persistent quality', function () {
            it('the quality is always 80', function () {
                $item = new LegendaryItem('x', 1, 1);

                for ($count = 1; $count < 5; $count++) {
                    expect($item->nextDay()->getQuality())->toBe(80);
                }
            });
        });

        describe('persistent lifespan', function () {
            it('the lifespan never changes', function () {
                $lifespan = 10;
                $item = new LegendaryItem('x', 1, $lifespan);

                for ($count = 1; $count < 5; $count++) {
                    expect($item->nextDay()->getSellIn())->toBe($lifespan);
                }
            });
        });
    });
});

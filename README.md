# The Elucidat 'Gilded Rose' Coding Test
[![lint-and-test](https://github.com/monooso/elucidat-php-code-test/actions/workflows/lint-and-test.yml/badge.svg)](https://github.com/monooso/elucidat-php-code-test/actions/workflows/lint-and-test.yml)

## Solution notes
The solution replaces the existing conditionals with polymorphism. Each item type class has a common interface (`App\Contracts\ItemInterface`), and encapsulates the business logic for that type.

### Ambiguities
The existing code performed some quality score calculations _before_ updating the item lifespan, and others _after_ updating the item lifespan. This led to some apparently inconsistent behaviour.

Under normal circumstances, I would have discussed the requirements with a domain expert. As that wasn't an option here, [I opted for consistency][fixed-commit].

[fixed-commit]: https://github.com/monooso/elucidat-php-code-test/commit/fa9cb7de03876df5d6168106a726752b4bf822be

### Tooling
- [PHP CS Fixer][php-cs-fixer] enforces coding style.
- [Husky][husky] automatically tests and lints code before commit and push.
- [GitHub Actions][gh-actions] keep the repository pristine.
- A bash script simplifies set-up. See the revised "Getting started" section for details.

 [gh-actions]: https://github.com/features/actions
 [husky]: https://typicode.github.io/husky/#/
 [php-cs-fixer]: https://github.com/FriendsOfPHP/PHP-CS-Fixer

## The task
This repository includes the initial setup for a Gilded Rose kata.  It includes everything you need to get up and running, including a large suite of tests.  The purpose of this task is to put you in the position of having some old, ugly, legacy code and seeing whay you could do with it, all of the while making any of your changes test-driven and ensuring everything continues to pass the tests (or any more tests you would write). 

Please follow the specifications below, refactoring as you see fit.  However, please keep the following in mind:

- All the of tests are expected to pass
- You will need to uncomment the tests for the new item type
- Any new code you write should be covered by tests if it's not already
- Keep good design principles in mind when you refactor the code
- You only need to spend an hour or two on this

## Getting started
1. Clone the repository: `git clone git@github.com:monooso/elucidat-php-code-test.git`
2. Run the setup script: `bash scripts/setup.sh`
3. Run the test suite (written with [Kahlan](https://kahlan.github.io/docs/)) to confirm everything is working correctly: `./vendor/bin/kahlan`

## Specifications
Hi and welcome to team Gilded Rose. As you know, we are a small inn with a prime location in a
prominent city ran by a friendly innkeeper named Allison. We also buy and sell only the finest goods.

Unfortunately, our goods are constantly degrading in quality as they approach their sell by date. We
have a system in place that updates our inventory for us. It was developed by a no-nonsense type named Leeroy, who has moved on to new adventures. Your task is to add the new item to our system so that we can begin selling a new category of items. First an introduction to our system:

- All items have a SellIn value which denotes the number of days we have to sell the item
- All items have a Quality value which denotes how valuable the item is
- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the sell by date has passed, Quality degrades twice as fast
- The Quality of an item is never negative
- "Aged Brie" actually increases in Quality the older it gets
- The Quality of an item is never more than 50
- "Sulfuras", being a legendary item, never has to be sold or decreases in Quality
- "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches; Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but Quality drops to 0 after the concert

We have recently signed a supplier of conjured items. This requires an update to our system:

- "Conjured" items degrade in Quality twice as fast as normal items

Feel free to make any changes to the `nextDay` method and add any new code as long as everything
still works correctly. However, do not alter the `Item` class or `items` property as those belong to the goblin in the corner who will insta-rage you as he doesn't believe in shared code ownership (you can make the `nextDay` method and `items` property static if you like, we'll cover for you).

Just for clarification, an item can never have its Quality increase above 50, however "Sulfuras" is a legendary item and as such its Quality is 80 and it never alters.

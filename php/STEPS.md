# GildedRose Kata

## Setup docker

Running DDEV for environment, could have used WardenEnv or plain Dockerfile as well. 

```ddev config```

Using a normal PHP setup, but taking out the "db" container.

- see .ddev/config.yaml

Followed by

```ddev start```

Validate with ```ddev ssh``` that the project is running. Also easier to be inside the container instead of having to use wrappers constantly.

## Tests and checks (collected to summerize)

Running fixtures within the docker container

```php fixtures/texttest_fixture.php 10```

Running the tests via composer

```composer tests```

Tests plus coverage result

```composer test-coverage```

Coding standards check

```composer check-cs```

Automatich CS fixes

```composer fix-cs```

Static analysis

```composer phpstan```

## Build(s)

### Single file

The `GildedRose` class has a lot of if-else statements that are difficult to read. Opting to use the conditions from Readme instead of unscrambling logic line by line.

Using the Readme as to how items should behave, writing the methods per level (starting with placeholders) in `GildedRose`.

Fleshing out methods after flow seems correct.

For quality there should be:

- `updateItemQuality` (to not interfere with `updateQuality` method)
- `canUpdateItemQuality` to determine updateable
- `updateExpiredItemQuality` for further decline in sellIn below 0
- `updateNonExpiredQuality` for decling sellIn above 0
- `increaseQuality`
- `decreaseQuality`
- `resetQuality` due to Backstage passes

For sellIn there should be:

- `updateSellIn`
- `canUpdateSellin` due to Sulfuras 

Conditional logic is handled per method where a deviation is expected.

Started implementing constants for the item names.

Fixtures give correct calculations in terminal. However, the item `Conjured` is not correct. Turning this off for now. 

Had to figure out why the tests initially did not work correctly. This is because one output does, and the other does not, have an additional enter for some reason. Trimmed the result in the testfile coming from the fixture. 

Removed the Foo tests. 

Added tests per item-type to trigger GildedRose's output (`GildedRoseTest`).

### Strategy pattern

The single file build counts a class with 150+ lines of code. It works, but there is no SoC and matches (no switch-statements) are still scattered everywhere.

Kept the GildedRose `updateQuality` method, but changed it by using `match()` to trigger certain `Strategy/Updater` classes based on the type of item if it requires different logic than the normal flow.

Moved methods from `GildedRose` to the abstract `BaseItemUpdater`. Renaming done by dropping the "Item" part in the method name.

Using inheritance to prevent writing quality and sellIn functions double. Logic is still inside these functions albeit there is some more SoC now.

### Composition over inheritance

We need a little overkill, taking Magento as "inspiration".

Instead of just cleaning up the methods inside the base-class for the `Strategy/Updaters` (e.g. conditional logic), introduced a `Strategy/Updaters/Concerns` folder. This based on primarily the two functionalities of quality and sellIn. Using `Concern` based on Laravel's `InteractsWith...`.

### Last steps overview

- the base class is used by all updaters (inheritance)
- the base class uses traits (Concerns, overkill but otherwise too much `use trait here` duplication)
- each updater overrides a method from a trait (concerns) if need be
- in the `GildedRose` file the only requirement now is matching the item with an updater
- checking for matching is done by using values from an `ItemEnum`
- GildedRose could have used a `Factory` for the updaters, but skipped on that
- did not write unit tests for the underlaying classes that `GildedRose` uses e.g. updaters and concerns. Would have if building fully TDD
- methods appear to not have side-effects in such a way that they are unexpected

### Enumeration usage

Full strings as mentioned in the assignment have been used.

For conditionally different items, we could have used a `string contains` or a `string starts with` but chose not to.

## Feature implementation

Adding in `Conjured-*`:

- copied `ItemUpdater` to `ConjuredUpdater`
- added `decreaseQuality` override (internally multiply parameter value by 2)
- registered the `ItemEnum` value for this item-type
- added the condition inside `GildedRose`'s `match()` for calling `ConjuredUpdater`
- enabled `Conjured` item for testing
- ran tests (updated *.approved.* file) No debugging was needed

## Code Quality

After each build-iteration ran tests and the CS plus PHPStan functionalities. Did not commit the builds or these steps on purpose. Could have done though, using this file instead for documenting steps.

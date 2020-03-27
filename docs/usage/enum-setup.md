---
title: Enum Setup
weight: 1
---

## Basic Enum

The most basic setup to define an enum by using php-doc annotations.

```php
use Spatie\Enum\Enum;

/**
 * @method static self monday()
 * @method static self tuesday()
 * @method static self wednesday()
 * @method static self thursday()
 * @method static self friday()
 * @method static self saturday()
 * @method static self sunday()
 *
 * @method static bool isMonday(int|string $value = null)
 * @method static bool isTuesday(int|string $value = null)
 * @method static bool isWednesday(int|string $value = null)
 * @method static bool isThursday(int|string $value = null)
 * @method static bool isFriday(int|string $value = null)
 * @method static bool isSaturday(int|string $value = null)
 * @method static bool isSunday(int|string $value = null)
 */
final class WeekDayEnum extends Enum
{
}
```

## Custom value/index Enum

> This enum will be used in following chapters.

### by Constants

This is the easiest way to change the value/index by it's enum name. The key of both arrays is the name of the method it's accessed by and the value MUST be a `string` for the value map and an `int` for the index map.

```php
use Spatie\Enum\Enum;
/**
 * @method static self monday()
 * @method static self tuesday()
 * @method static self wednesday()
 * @method static self thursday()
 * @method static self friday()
 * @method static self saturday()
 * @method static self sunday()
 *
 * @method static bool isMonday(int|string $value = null)
 * @method static bool isTuesday(int|string $value = null)
 * @method static bool isWednesday(int|string $value = null)
 * @method static bool isThursday(int|string $value = null)
 * @method static bool isFriday(int|string $value = null)
 * @method static bool isSaturday(int|string $value = null)
 * @method static bool isSunday(int|string $value = null)
 */
final class WeekDayEnum extends Enum
{
    const MAP_INDEX = [
        'monday' => 1,
        'tuesday' => 2,
        'wednesday' => 3,
        'thursday' => 4,
        'friday' => 5,
        'saturday' => 6,
        'sunday' => 7,
    ];
     const MAP_VALUE = [
        'monday' => 'Montag',
        'tuesday' => 'Dienstag',
        'wednesday' => 'Mittwoch',
        'thursday' => 'Donnerstag',
        'friday' => 'Freitag',
        'saturday' => 'Samstag',
        'sunday' => 'Sonntag',
    ];
}
```

### by Methods

This approach offers much more flexibility because you can use the return value of a function for the value/index resolving. Keep in mind that these methods are called once for the enum cache (used to make an enum) but called everytime you access the value/index via the getters.

So if you use, for example, `time()` for the index you can only make the enum by the timestamp the enum was first cached but you will get the current timestamp if you call `getIndex()`.

```php
use Spatie\Enum\Enum;

/**
 * @method static bool isMonday(int|string $value = null)
 * @method static bool isTuesday(int|string $value = null)
 * @method static bool isWednesday(int|string $value = null)
 * @method static bool isThursday(int|string $value = null)
 * @method static bool isFriday(int|string $value = null)
 * @method static bool isSaturday(int|string $value = null)
 * @method static bool isSunday(int|string $value = null)
 */
abstract class WeekDayEnum extends Enum
{
    public static function monday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 1;
            }

            public function getValue(): string
            {
                return 'Montag';
            }
        };
    }

    public static function tuesday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 2;
            }

            public function getValue(): string
            {
                return 'Dienstag';
            }
        };
    }

    public static function wednesday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 3;
            }

            public function getValue(): string
            {
                return 'Mittwoch';
            }
        };
    }

    public static function thursday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 4;
            }

            public function getValue(): string
            {
                return 'Donnerstag';
            }
        };
    }

    public static function friday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 5;
            }

            public function getValue(): string
            {
                return 'Freitag';
            }
        };
    }

    public static function saturday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 6;
            }

            public function getValue(): string
            {
                return 'Samstag';
            }
        };
    }

    public static function sunday(): WeekDayEnum
    {
        return new class() extends WeekDayEnum {
            public function getIndex(): int
            {
                return 7;
            }

            public function getValue(): string
            {
                return 'Sonntag';
            }
        };
    }
}
```

---
title: Enum Setup
weight: 1
---

## Basic Enum

The most basic setup to define an enum by using php-doc annotations.

```php
use Spatie\Enum\Enum;

/**
 * @method static bool monday()
 * @method static bool tuesday()
 * @method static bool wednesday()
 * @method static bool thursday()
 * @method static bool friday()
 * @method static bool saturday()
 * @method static bool sunday()
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

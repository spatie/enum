<?php

namespace Spatie\Enum\Tests\Enums;

use Spatie\Enum\Enum;

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

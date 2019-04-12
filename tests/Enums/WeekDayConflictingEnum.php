<?php

namespace Spatie\Enum\Tests\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self thursday()
 */
class WeekDayConflictingEnum extends Enum
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

    public static function monday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 10;
            }

            public function getValue(): string
            {
                return 'lundi';
            }
        };
    }

    public static function tuesday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 20;
            }

            public function getValue(): string
            {
                return 'mardi';
            }
        };
    }

    public static function wednesday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 30;
            }

            public function getValue(): string
            {
                return 'mercredi';
            }
        };
    }

    public static function friday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 50;
            }

            public function getValue(): string
            {
                return 'vendredi';
            }
        };
    }

    public static function saturday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 60;
            }

            public function getValue(): string
            {
                return 'samedi';
            }
        };
    }

    public static function sunday(): WeekDayConflictingEnum
    {
        return new class() extends WeekDayConflictingEnum {
            public function getIndex(): int
            {
                return 70;
            }

            public function getValue(): string
            {
                return 'dimanche';
            }
        };
    }
}

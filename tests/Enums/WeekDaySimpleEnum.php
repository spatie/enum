<?php

namespace Spatie\Enum\Tests\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self monday()
 * @method static self tuesday()
 * @method static self wednesday()
 * @method static self thursday()
 * @method static self friday()
 * @method static self saturday()
 * @method static self sunday()
 */
final class WeekDaySimpleEnum extends Enum
{
    const MAP_INDEX = [
        'MONDAY' => 1,
        'TUESDAY' => 2,
        'WEDNESDAY' => 3,
        'THURSDAY' => 4,
        'FRIDAY' => 5,
        'SATURDAY' => 6,
        'SUNDAY' => 7,
    ];

    const MAP_VALUE = [
        'MONDAY' => 'Montag',
        'TUESDAY' => 'Dienstag',
        'WEDNESDAY' => 'Mittwoch',
        'THURSDAY' => 'Donnerstag',
        'FRIDAY' => 'Freitag',
        'SATURDAY' => 'Samstag',
        'SUNDAY' => 'Sonntag',
    ];
}

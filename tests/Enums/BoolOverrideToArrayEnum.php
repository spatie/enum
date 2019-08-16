<?php

namespace Spatie\Enum\Tests\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self false()
 * @method static self true()
 *
 * @method static bool isFalse(int|string $value = null)
 * @method static bool isTrue(int|string $value = null)
 */
final class BoolOverrideToArrayEnum extends Enum
{
    public static function toArray(): array
    {
        return array_combine(static::getValues(), static::getNames());
    }
}

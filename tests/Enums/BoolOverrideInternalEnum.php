<?php

namespace Spatie\Enum\Tests\Enums;

use ReflectionClass;
use Spatie\Enum\Enum;

/**
 * @method static self false()
 * @method static self true()
 *
 * @method static bool isFalse(int|string $value = null)
 * @method static bool isTrue(int|string $value = null)
 */
final class BoolOverrideInternalEnum extends Enum
{
    public function testMethod()
    {
        return true;
    }

    public static function test($a)
    {
    }

    protected static function resolveFromStaticMethods(ReflectionClass $reflection): array
    {
        return [];
    }
}

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
final class BoolEnum extends Enum
{
    public function testMethod()
    {
        return true;
    }
}

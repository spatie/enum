<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;

test('is', function () {
    $this->assertTrue(EnumToCompare::A()->isA());
    $this->assertFalse(EnumToCompare::A()->isB());

    $this->assertTrue(EnumToCompare::B()->isB());
    $this->assertFalse(EnumToCompare::B()->isA());
});

test('is with value map', function () {
    $this->assertTrue(EnumToCompareWithValueMap::A()->isA());
    $this->assertFalse(EnumToCompareWithValueMap::A()->isB());

    $this->assertTrue(EnumToCompareWithValueMap::B()->isB());
    $this->assertFalse(EnumToCompareWithValueMap::B()->isA());
});


/**
 * @method static self A()
 * @method static self B()
 *
 * @method bool isA
 * @method bool isB
 */
class EnumToCompare extends Enum
{
}

/**
 * @method static self A()
 * @method static self B()
 *
 * @method bool isA
 * @method bool isB
 */
class EnumToCompareWithValueMap extends Enum
{
    protected static function values(): array
    {
        return [
            'A' => 1,
            'B' => 2,
        ];
    }
}

<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;

test('is', function () {
    expect(EnumToCompare::A()->isA())->toBeTrue();
    expect(EnumToCompare::A()->isB())->toBeFalse();

    expect(EnumToCompare::B()->isB())->toBeTrue();
    expect(EnumToCompare::B()->isA())->toBeFalse();
});

test('is with value map', function () {
    expect(EnumToCompareWithValueMap::A()->isA())->toBeTrue();
    expect(EnumToCompareWithValueMap::A()->isB())->toBeFalse();

    expect(EnumToCompareWithValueMap::B()->isB())->toBeTrue();
    expect(EnumToCompareWithValueMap::B()->isA())->toBeFalse();
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

<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;

test('to array', function () {
    expect(
        ['A' => 'A', 'B' => 'B']
    )->toBe(SimpleEnumAsArray::toArray());

    expect(
        ['A', 'B']
    )->toBe(SimpleEnumAsArray::toValues());

    expect(
        ['A', 'B']
    )->toBe(SimpleEnumAsArray::toLabels());
});

test('to array with value and label map', function () {
    expect(
        ['A' => 'a', 2 => 'B']
    )->toBe(EnumAsArray::toArray());

    expect(
        ['A', 2]
    )->toBe(EnumAsArray::toValues());

    expect(
        ['a', 'B']
    )->toBe(EnumAsArray::toLabels());
});

test('cases', function () {
    $all = SimpleEnumAsArray::cases();

    expect(SimpleEnumAsArray::A()->equals($all[0]))->toBeTrue();
    expect(SimpleEnumAsArray::B()->equals($all[1]))->toBeTrue();
});

/**
 * @method static self A()
 * @method static self B()
 */
class EnumAsArray extends Enum
{
    protected static function labels(): array
    {
        return [
            'A' => 'a',
        ];
    }

    protected static function values(): array
    {
        return [
            'B' => 2
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class SimpleEnumAsArray extends Enum
{
}

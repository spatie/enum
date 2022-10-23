<?php

namespace Spatie\Enum\Tests;

use Spatie\Enum\Enum;

test('to array', function () {
    $this->assertSame(
        ['A' => 'A', 'B' => 'B'],
        SimpleEnumAsArray::toArray()
    );

    $this->assertSame(
        ['A', 'B'],
        SimpleEnumAsArray::toValues()
    );

    $this->assertSame(
        ['A', 'B'],
        SimpleEnumAsArray::toLabels()
    );
});

test('to array with value and label map', function () {
    $this->assertSame(
        ['A' => 'a', 2 => 'B'],
        EnumAsArray::toArray()
    );

    $this->assertSame(
        ['A', 2],
        EnumAsArray::toValues()
    );

    $this->assertSame(
        ['a', 'B'],
        EnumAsArray::toLabels()
    );
});

test('cases', function () {
    $all = SimpleEnumAsArray::cases();

    $this->assertTrue(SimpleEnumAsArray::A()->equals($all[0]));
    $this->assertTrue(SimpleEnumAsArray::B()->equals($all[1]));
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

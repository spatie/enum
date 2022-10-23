<?php

namespace Spatie\Enum\Tests;

use Closure;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateValuesException;

test('value on enum', function () {
    $this->assertEquals(1, EnumWithValues::A()->value);
    $this->assertEquals(2, EnumWithValues::B()->value);
});

test('construct from all possible values', function () {
    $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('A')));
    $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('a')));
    $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('1')));
    $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues(1)));

    $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('B')));
    $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('b')));
    $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('2')));
    $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues(2)));
});

test('duplicate labels are not allowed', function () {
    $this->expectException(DuplicateValuesException::class);

    EnumWithDuplicatedValues::A();
});

test('json serialize returns same value type', function () {
    $this->assertSame(1, EnumWithValues::A()->jsonSerialize());
    $this->assertSame(2, EnumWithValues::B()->jsonSerialize());
});

it('can automatically map values', function () {
    $this->assertEquals('va', EnumWithAutomaticMappedValues::A()->value);
    $this->assertEquals('vb', EnumWithAutomaticMappedValues::B()->value);
});


/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithValues extends Enum
{
    protected static function values(): array
    {
        return [
            'A' => 1,
            'B' => 2,
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithDuplicatedValues extends Enum
{
    protected static function values(): array
    {
        return [
            'A' => 1,
            'B' => 1,
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithAutomaticMappedValues extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => 'v'.strtolower($name);
    }
}

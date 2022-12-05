<?php

namespace Spatie\Enum\Tests;

use Closure;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateValuesException;

test('value on enum', function () {
    expect(1)->toEqual(EnumWithValues::A()->value);
    expect(2)->toEqual(EnumWithValues::B()->value);
});

test('construct from all possible values', function () {
    expect(EnumWithValues::A()->equals(new EnumWithValues('A')))->toBeTrue();
    expect(EnumWithValues::A()->equals(new EnumWithValues('a')))->toBeTrue();
    expect(EnumWithValues::A()->equals(new EnumWithValues('1')))->toBeTrue();
    expect(EnumWithValues::A()->equals(new EnumWithValues(1)))->toBeTrue();

    expect(EnumWithValues::B()->equals(new EnumWithValues('B')))->toBeTrue();
    expect(EnumWithValues::B()->equals(new EnumWithValues('b')))->toBeTrue();
    expect(EnumWithValues::B()->equals(new EnumWithValues('2')))->toBeTrue();
    expect(EnumWithValues::B()->equals(new EnumWithValues(2)))->toBeTrue();
});

test('duplicate labels are not allowed', function () {

    expect(fn() => EnumWithDuplicatedValues::A())->toThrow(DuplicateValuesException::class);
});

test('json serialize returns same value type', function () {
    expect(1)->toBe(EnumWithValues::A()->jsonSerialize());
    expect(2)->toBe(EnumWithValues::B()->jsonSerialize());
});

it('can automatically map values', function () {
    expect('va')->toEqual(EnumWithAutomaticMappedValues::A()->value);
    expect('vb')->toEqual(EnumWithAutomaticMappedValues::B()->value);
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

<?php

namespace Spatie\Enum\Tests;

use Closure;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateLabelsException;


it('can turn labels into array', function() {
    expect([
        'A' => 'a',
        'B' => 'B'
    ])->toEqual(EnumWithLabels::toArray());
});

test('label on enum', function () {
    expect('a')->toEqual(EnumWithLabels::A()->label);
    expect('B')->toEqual(EnumWithLabels::B()->label);
});

test('duplicate labels are not allowed', function () {

    expect(fn() => EnumWithDuplicateLabels::A())->toThrow(DuplicateLabelsException::class);
});

it('can automatically map labels', function () {
    expect('la')->toEqual(EnumWithAutomaticMappedLabels::A()->value);
    expect('lb')->toEqual(EnumWithAutomaticMappedLabels::B()->value);
});


/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithLabels extends Enum
{
    protected static function labels(): array
    {
        return [
            'A' => 'a',
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithDuplicateLabels extends Enum
{
    protected static function labels(): array
    {
        return [
            'A' => 'a',
            'B' => 'a',
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithAutomaticMappedLabels extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => 'l'.strtolower($name);
    }
}

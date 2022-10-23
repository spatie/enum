<?php

namespace Spatie\Enum\Tests;

use Closure;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateLabelsException;


test('labels into array', function() {
    $this->assertEquals([
        'A' => 'a',
        'B' => 'B'
    ], EnumWithLabels::toArray());
});

test('label on enum', function () {
    $this->assertEquals('a', EnumWithLabels::A()->label);
    $this->assertEquals('B', EnumWithLabels::B()->label);
});

test('duplicate labels are not allowed', function () {
    $this->expectException(DuplicateLabelsException::class);

    EnumWithDuplicateLabels::A();
});

it('can automatically map labels', function () {
    $this->assertEquals('la', EnumWithAutomaticMappedLabels::A()->value);
    $this->assertEquals('lb', EnumWithAutomaticMappedLabels::B()->value);
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

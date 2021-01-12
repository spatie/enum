<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumToArrayTest extends TestCase
{
    /** @test */
    public function test_to_array()
    {
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
    }

    /** @test */
    public function test_to_array_with_value_and_label_map()
    {
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
    }
}

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

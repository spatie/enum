<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumToArrayTest extends TestCase
{
    /** @test */
    public function test_to_array()
    {
        $array = SimpleEnumAsArray::toArray();

        $this->assertEquals(
            ['A' => 'A', 'B' => 'B'],
            $array
        );
    }

    /** @test */
    public function test_to_array_with_value_and_label_map()
    {
        $array = EnumAsArray::toArray();

        $this->assertEquals(
            ['A' => 'a', 2 => 'B'],
            $array
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
class SimpleEnumAsArray extends Enum {}

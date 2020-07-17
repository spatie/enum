<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumIsTest extends TestCase
{
    /** @test */
    public function test_is()
    {
        $this->assertTrue(EnumToCompare::A()->isA());
        $this->assertFalse(EnumToCompare::A()->isB());

        $this->assertTrue(EnumToCompare::B()->isB());
        $this->assertFalse(EnumToCompare::B()->isA());
    }

    /** @test */
    public function test_is_with_value_map()
    {
        $this->assertTrue(EnumToCompareWithValueMap::A()->isA());
        $this->assertFalse(EnumToCompareWithValueMap::A()->isB());

        $this->assertTrue(EnumToCompareWithValueMap::B()->isB());
        $this->assertFalse(EnumToCompareWithValueMap::B()->isA());
    }

    /** @test */
    public function test_is_with_invalid_values()
    {
        $this->assertFalse(EnumToCompare::A()->isC());
        $this->assertFalse(EnumToCompare::B()->isC());
    }
}

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

<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumValueTest extends TestCase
{
    /** @test */
    public function test_value_on_enum()
    {
        $this->assertEquals(1, EnumWithValues::A()->value);
        $this->assertEquals('B', EnumWithValues::B()->value);
    }

    /** @test */
    public function construct_from_method_name()
    {
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('A')));
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues(1)));
    }
}

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
        ];
    }
}

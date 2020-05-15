<?php

namespace Spatie\Enum\Tests;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumTest extends TestCase
{
    /** @test */
    public function enums_can_be_constructed()
    {
        $enum = MyEnum::A();

        $this->assertInstanceOf(MyEnum::class, $enum);
    }

    /** @test */
    public function unknown_enum_method_triggers_exception()
    {
        $this->expectException(BadMethodCallException::class);

        MyEnum::C();
    }

    /** @test */
    public function test_equals()
    {
        $this->assertTrue(MyEnum::A()->equals(MyEnum::A()));
        $this->assertFalse(MyEnum::A()->equals(MyEnum::B()));
    }

    /** @test */
    public function test_is_any()
    {
        $this->assertTrue(MyEnum::A()->equalsAny(
            MyEnum::A(),
            MyEnum::B(),
        ));

        $this->assertFalse(MyEnum::A()->equalsAny(
            MyEnum::B(),
        ));
    }

    /** @test */
    public function test_to_array()
    {
        $array = MyEnum::toArray();

        $this->assertEquals(
            ['A' => 'A', 'B' => 'B'],
            $array
        );
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class MyEnum extends Enum {}

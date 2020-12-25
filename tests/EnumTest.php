<?php

namespace Spatie\Enum\Tests;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use TypeError;

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
    public function invalid_value_type_throws_exception()
    {
        $this->expectException(TypeError::class);

        MyEnum::make([]);
    }

    /** @test */
    public function test_equals()
    {
        $this->assertTrue(MyEnum::A()->equals(MyEnum::A()));
        $this->assertFalse(MyEnum::A()->equals(MyEnum::B()));
    }

    /** @test */
    public function test_equals_multiple()
    {
        $this->assertTrue(MyEnum::A()->equals(
            MyEnum::A(),
            MyEnum::B(),
        ));

        $this->assertFalse(MyEnum::A()->equals(
            MyEnum::B(),
        ));
    }

    /** @test */
    public function to_json()
    {
        $json = json_encode(MyEnum::A());

        $this->assertEquals('"A"', $json);
    }

    /** @test */
    public function to_string()
    {
        $string = (string) MyEnum::A();

        $this->assertEquals('A', $string);
    }

    /** @test */
    public function use_enum_construct_within_an_enum()
    {
        $enum = EnumWithEnum::A();

        $this->assertTrue(EnumWithEnum::B()->equals($enum->test()));
    }

    /** @test */
    public function enum_docblock_whitespaces() {
        $this->assertInstanceOf(BadDockBlockEnum::class, BadDockBlockEnum::A());
        $this->assertInstanceOf(BadDockBlockEnum::class, BadDockBlockEnum::B());
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class MyEnum extends Enum
{
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithEnum extends Enum
{
    public function test()
    {
        return EnumWithEnum::B();
    }
}

/**
 * @method  static  self       A()
 * @method  static    self       B()
 */
class BadDockBlockEnum extends Enum {

}

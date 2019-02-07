<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Extra\MyEnum;
use Spatie\Enum\Tests\Extra\RecursiveEnum;
use TypeError;

class EnumTest extends TestCase
{
    /** @test */
    public function an_enum_can_be_constructed()
    {
        $enumValue = MyEnum::bar();

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('bar', $enumValue);
    }

    /** @test */
    public function an_enum_can_specify_its_value()
    {
        $enumValue = MyEnum::foo();

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('foovalue', $enumValue);
    }

    /** @test */
    public function using_an_invalid_enum_value_throws_a_tyoe_error()
    {
        $this->expectException(TypeError::class);

        MyEnum::wrong();
    }

    /** @test */
    public function recursive_enum_test()
    {
        $enumValue = RecursiveEnum::foo();

        $this->assertEquals('test', $enumValue);
    }

    /** @test */
    public function equals_test()
    {
        $a = MyEnum::bar();

        $b = MyEnum::bar();

        $c = MyEnum::foo();

        $d = RecursiveEnum::foo();

        $this->assertTrue($a->equals($a));
        $this->assertTrue($a->equals($b));
        $this->assertFalse($a->equals($c));
        $this->assertFalse($a->equals($d));
    }

    /** @test */
    public function to_array_test()
    {
        $this->assertEquals([
            'foo' => 'foovalue',
            'bar' => 'bar',
        ], MyEnum::toArray());
    }

    /** @test */
    public function create_from_value_test()
    {
        $enum = MyEnum::from('bar');

        $this->assertTrue(MyEnum::bar()->equals($enum));
    }
}

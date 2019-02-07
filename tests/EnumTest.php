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
        $enumValue = MyEnum::BAR();

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('BAR', $enumValue);
    }

    /** @test */
    public function an_enum_can_specify_its_value()
    {
        $enumValue = MyEnum::FOO();

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('foovalue', $enumValue);
    }

    /** @test */
    public function using_an_invalid_enum_value_throws_a_tyoe_error()
    {
        $this->expectException(TypeError::class);

        MyEnum::WRONG();
    }

    /** @test */
    public function recursive_enum_test()
    {
        $enumValue = RecursiveEnum::FOO();

        $this->assertEquals('test', $enumValue);
    }
}

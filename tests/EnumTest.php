<?php

namespace Spatie\Enum\Tests;

use TypeError;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\TestClasses\MyEnum;
use Spatie\Enum\Tests\TestClasses\RecursiveEnum;

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
    public function it_can_compare_itself_to_other_instances()
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
    public function it_can_represent_itself_as_an_array()
    {
        $this->assertEquals([
            'foo' => 'foovalue',
            'bar' => 'bar',
        ], MyEnum::toArray());
    }

    /** @test */
    public function it_can_be_created_from_a_string()
    {
        $enum = MyEnum::from('bar');

        $this->assertTrue(MyEnum::bar()->equals($enum));
    }

    /** @test */
    public function is_one_of_test()
    {
        $array = [
            MyEnum::foo(),
            MyEnum::bar(),
        ];

        $this->assertTrue(MyEnum::foo()->isOneOf($array));
    }

    /** @test */
    public function json_encode_test()
    {
        $json = json_encode(MyEnum::bar());

        $this->assertEquals('"bar"', $json);
    }

    /** @test */
    public function it_can_represent_its_keys_as_an_array()
    {
        $this->assertEquals(['foo', 'bar'], MyEnum::getKeys());
    }

    /** @test */
    public function it_can_represent_its_values_as_an_array()
    {
        $this->assertEquals(['foovalue', 'bar'], MyEnum::getValues());
    }
}

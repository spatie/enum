<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests;

use TypeError;
use ArgumentCountError;
use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\TestClasses\MyEnum;
use Spatie\Enum\Tests\TestClasses\RecursiveEnum;
use Spatie\Enum\Exceptions\InvalidIndexException;
use Spatie\Enum\Exceptions\InvalidValueException;

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
    public function an_enum_can_be_made_by_value()
    {
        $enumValue = MyEnum::make('foo');

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('foo', $enumValue);
    }

    /** @test */
    public function an_enum_can_be_made_by_index()
    {
        $enumValue = MyEnum::make(0);

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('foo', $enumValue);
        $this->assertEquals(0, $enumValue->getIndex());
    }

    /** @test */
    public function using_an_invalid_enum_value_throws_a_type_error()
    {
        $this->expectException(BadMethodCallException::class);

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

        $this->assertTrue($a->isEqual($a));
        $this->assertTrue($a->isEqual($b));
        $this->assertFalse($a->isEqual($c));
        $this->assertFalse($a->isEqual($d));
    }

    /** @test */
    public function it_can_represent_itself_as_an_array()
    {
        $this->assertEquals([
            'foo' => 0,
            'bar' => 1,
            'Hello' => 2,
            'WORLD' => 3,
        ], MyEnum::toArray());
    }

    /** @test */
    public function it_can_be_created_from_a_string()
    {
        $enum = MyEnum::make('bar');

        $this->assertTrue(MyEnum::bar()->isEqual($enum));
    }

    /** @test */
    public function is_one_of_test()
    {
        $array = [
            MyEnum::foo(),
            MyEnum::bar(),
        ];

        $this->assertTrue(MyEnum::foo()->isAny($array));
        $this->assertFalse(MyEnum::Hello()->isAny($array));
    }

    /** @test */
    public function json_encode_test()
    {
        $json = json_encode(MyEnum::bar());

        $this->assertEquals('"bar"', $json);
    }

    /** @test */
    public function it_can_represent_its_indices_as_an_array()
    {
        $this->assertEquals([0, 1, 2, 3], MyEnum::getIndices());
    }

    /** @test */
    public function it_can_represent_its_values_as_an_array()
    {
        $this->assertEquals(['foo', 'bar', 'Hello', 'WORLD'], MyEnum::getValues());
    }

    /** @test */
    public function value_is_case_insensitive()
    {
        $hello = MyEnum::Hello();

        $this->assertInstanceOf(MyEnum::class, $hello);
        $this->assertEquals('Hello', $hello);
        $this->assertTrue($hello->isEqual(MyEnum::hello()));

        $world = MyEnum::WoRlD();

        $this->assertInstanceOf(MyEnum::class, $world);
        $this->assertEquals('WORLD', $world);
        $this->assertTrue($world->isEqual(MyEnum::worLD()));
    }

    /** @test */
    public function can_call_magic_is_methods()
    {
        $this->assertTrue(MyEnum::make('foo')->isFoo());
        $this->assertFalse(MyEnum::make('bar')->isFoo());

        $this->assertTrue(MyEnum::isFoo('foo'));
        $this->assertFalse(MyEnum::isFoo('bar'));
    }

    /** @test */
    public function throws_exception_if_made_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);

        MyEnum::make('foobar');
    }

    /** @test */
    public function throws_exception_if_made_with_invalid_index()
    {
        $this->expectException(InvalidIndexException::class);

        MyEnum::make(-1);
    }

    /** @test */
    public function throws_exception_if_made_with_invalid_argument_type()
    {
        $this->expectException(TypeError::class);

        MyEnum::make([]);
    }

    /** @test */
    public function throws_exception_if_constructed_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);

        new MyEnum('foobar', 0);
    }

    /** @test */
    public function throws_exception_if_constructed_with_invalid_index()
    {
        $this->expectException(InvalidIndexException::class);

        new MyEnum('foo', -1);
    }

    /** @test */
    public function throws_exception_if_call_to_undefined_method()
    {
        $this->expectException(BadMethodCallException::class);

        MyEnum::foo()->foobar();
    }

    /** @test */
    public function throws_exception_if_call_to_static_is_method_without_argument()
    {
        $this->expectException(ArgumentCountError::class);

        MyEnum::isFoo();
    }

    /** @test */
    public function throws_exception_if_constructed_without_arguments()
    {
        $this->expectException(InvalidValueException::class);

        new MyEnum();
    }
}

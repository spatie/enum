<?php

namespace Spatie\Enum\Tests;

use BadMethodCallException;
use Spatie\Enum\Enum;
use TypeError;

test('enums can be constructed', function () {
    $enum = MyEnum::A();

    $this->assertInstanceOf(MyEnum::class, $enum);
});

test('enums can be constructed with whitespace', function () {
    $this->assertInstanceOf(BadDockBlockEnum::class, BadDockBlockEnum::A());
    $this->assertInstanceOf(BadDockBlockEnum::class, BadDockBlockEnum::B());
});

test('enums can be strict compared', function () {
    $this->assertSame(MyEnum::A(), MyEnum::from('A'));
    $this->assertSame(MyEnum::A(), MyEnum::from('a'));
    $this->assertTrue(MyEnum::A() === MyEnum::from('a'));
});

test('unknown enum method triggers exception', function () {
    $this->expectException(BadMethodCallException::class);

    MyEnum::C();
});

test('invalid value type throws exception', function () {
    $this->expectException(TypeError::class);

    MyEnum::from([]);
});

test('equals', function () {
    $this->assertTrue(MyEnum::A()->equals(MyEnum::A()));
    $this->assertFalse(MyEnum::A()->equals(MyEnum::B()));
});

test('equals multiple', function () {
    $this->assertTrue(MyEnum::A()->equals(
        MyEnum::A(),
        MyEnum::B(),
    ));

    $this->assertFalse(MyEnum::A()->equals(
        MyEnum::B(),
    ));
});

test('to json', function () {
    $json = json_encode(MyEnum::A());

    $this->assertEquals('"A"', $json);
});

test('to string', function () {
    $string = (string) MyEnum::A();

    $this->assertEquals('A', $string);
});

test('use enum construct within an enum', function () {
    $enum = EnumWithEnum::A();

    $this->assertTrue(EnumWithEnum::B()->equals($enum->test()));
});


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
 * @method  static  self A()
 * @method  static    self B()
 */
class BadDockBlockEnum extends Enum
{
}

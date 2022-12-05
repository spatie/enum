<?php

namespace Spatie\Enum\Tests;

use BadMethodCallException;
use Spatie\Enum\Enum;
use TypeError;

test('enums can be constructed', function () {
    $enum = MyEnum::A();

    expect($enum)->toBeInstanceOf(MyEnum::class);
});

test('enums can be constructed with whitespace', function () {

    expect(BadDockBlockEnum::A())->toBeInstanceOf(BadDockBlockEnum::class);
    expect(BadDockBlockEnum::B())->toBeInstanceOf(BadDockBlockEnum::class);
});

test('enums can be strict compared', function () {

    expect(MyEnum::A())->toBe(MyEnum::from('A'));
    expect(MyEnum::A())->toBe(MyEnum::from('a'));
    expect(MyEnum::A() === MyEnum::from('a'))->toBeTrue();
});

test('unknown enum method triggers exception', function () {
    expect(fn() => MyEnum::C())->toThrow(BadMethodCallException::class);
});

test('invalid value type throws exception', function () {

    expect(fn() => MyEnum::from([]))->toThrow(TypeError::class);
});

test('equals', function () {
    expect(MyEnum::A()->equals(MyEnum::A()))->toBeTrue();
    expect(MyEnum::A()->equals(MyEnum::B()))->toBeFalse();
});

test('equals multiple', function () {
    expect(MyEnum::A()->equals(
        MyEnum::A(),
        MyEnum::B(),
    ))->toBeTrue();

    expect(MyEnum::A()->equals(
        MyEnum::B(),
    ))->toBeFalse();
});

test('to json', function () {
    $json = json_encode(MyEnum::A());

    expect('"A"')->toEqual($json);
});

test('to string', function () {
    $string = (string) MyEnum::A();

    expect('A')->toEqual($string);
});

test('use enum construct within an enum', function () {
    $enum = EnumWithEnum::A();

    expect(EnumWithEnum::B()->equals($enum->test()))->toBeTrue();
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

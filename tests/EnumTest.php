<?php

namespace Spatie\Enum\Tests;

use BadMethodCallException;
use Spatie\Enum\Enum;
use TypeError;

it('can construct enums', function () {
    $enum = MyEnum::A();

    expect($enum)->toBeInstanceOf(MyEnum::class);
});

it('can construct enums with whitespace', function () {
    expect(BadDockBlockEnum::A())->toBeInstanceOf(BadDockBlockEnum::class);
    expect(BadDockBlockEnum::B())->toBeInstanceOf(BadDockBlockEnum::class);
});

it('can strict compare enums', function () {
    expect(MyEnum::A())->toBe(MyEnum::from('A'));
    expect(MyEnum::A())->toBe(MyEnum::from('a'));
    expect(MyEnum::A() === MyEnum::from('a'))->toBeTrue();
});

it('triggers exception for unknown enum method', function () {
    expect(fn () => MyEnum::C())->toThrow(BadMethodCallException::class);
});

it('throws exception for invalid value type', function () {
    expect(fn () => MyEnum::from([]))->toThrow(TypeError::class);
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

it('can turn enum to json', function () {
    $json = json_encode(MyEnum::A());

    expect('"A"')->toEqual($json);
});

it('can turn enum to string', function () {
    $string = (string) MyEnum::A();

    expect('A')->toEqual($string);
});

it('can use enum construct within an enum', function () {
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

<?php

namespace Spatie\Enum\Tests\Faker;

use Spatie\Enum\Enum;

beforeEach(function() {
    for ($i = 0; $i < 100; $i++) {
        yield [];
    }
});

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum instances', function () {
    $enum = fakerGeneratorInit()->randomEnum(RandomizedEnum::class);
    $this->assertInstanceOf(RandomizedEnum::class, $enum);
});

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum values', function () {
   $value = fakerGeneratorInit()->randomEnumValue(RandomizedEnum::class);

   $this->assertIsString($value);
   $this->assertInstanceOf(RandomizedEnum::class, RandomizedEnum::make($value));
   $this->assertTrue(in_array($value, RandomizedEnum::toValues(), true));
});

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum labels', function() {
    $label = fakerGeneratorInit()->randomEnumLabel(RandomizedEnum::class);

    $this->assertIsString($label);
    $this->assertInstanceOf(RandomizedEnum::class, RandomizedEnum::make($label));
    $this->assertTrue(in_array($label, RandomizedEnum::toLabels(), true));
});
//
//function repeatHundredTimes(): iterable
//{
//    for ($i = 0; $i < 100; $i++) {
//        yield [];
//    }
//}

/**
 * @method static self A()
 * @method static self B()
 */
class RandomizedEnum extends Enum
{
}

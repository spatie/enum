<?php

namespace Spatie\Enum\Tests\Faker;

use Spatie\Enum\Enum;


/**
 * @test
 * @dataProvider repeatHundredTimes
 */
test('it runs 100 times', function ($iteration) {
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
})->with(range(1,100));

/**
 * @method static self A()
 * @method static self B()
 */
class RandomizedEnum extends Enum
{
}

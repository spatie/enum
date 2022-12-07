<?php

namespace Spatie\Enum\Tests\Faker;

use Spatie\Enum\Enum;

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum instances', function () {
    $enum = fakerGeneratorInit()->randomEnum(RandomizedEnum::class);

    expect($enum)->toBeInstanceOf(RandomizedEnum::class);
})->group('generator');

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum values', function () {
    $value = fakerGeneratorInit()->randomEnumValue(RandomizedEnum::class);

    expect($value)->toBeString();
    expect(RandomizedEnum::make($value))->toBeInstanceOf(RandomizedEnum::class);
    expect(in_array($value, RandomizedEnum::toValues(), true))->toBeTrue();
})->group('generator');

/**
 * @test
 * @dataProvider repeatHundredTimes
 */
it('can generate random enum labels', function () {
    $label = fakerGeneratorInit()->randomEnumLabel(RandomizedEnum::class);

    expect($label)->toBeString();
    expect(RandomizedEnum::make($label))->toBeInstanceOf(RandomizedEnum::class);
    expect(in_array($label, RandomizedEnum::toLabels(), true))->toBeTrue();
})->group('generator');

/**
 * @method static self A()
 * @method static self B()
 */
class RandomizedEnum extends Enum
{
}

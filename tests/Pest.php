<?php

use Faker\Generator as FakerGenerator;
use Spatie\Enum\Faker\FakerEnumProvider;

/** @return FakerGenerator&FakerEnumProvider */
function fakerGeneratorInit(): FakerGenerator
{
    $faker = new FakerGenerator();
    $faker->addProvider(new FakerEnumProvider($faker));

    /** @var FakerGenerator&FakerEnumProvider $faker the provider's methods are reached through __call() */
    return $faker;
}

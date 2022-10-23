<?php

use Faker\Generator as FakerGenerator;
use Spatie\Enum\Faker\FakerEnumProvider;

function fakerGeneratorInit(): FakerGenerator
{
    $faker = new FakerGenerator();
    $faker->addProvider(new FakerEnumProvider($faker));

    return $faker;
}

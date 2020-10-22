<?php

namespace Spatie\Enum\Tests\Faker;

use Faker\Generator as FakerGenerator;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Faker\FakerEnumProvider;

final class FakerEnumProviderTest extends TestCase
{
    /** @var FakerGenerator|FakerEnumProvider */
    protected FakerGenerator $faker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faker = new FakerGenerator();
        $this->faker->addProvider(new FakerEnumProvider($this->faker));
    }

    /**
     * @test
     * @dataProvider repeatHundredTimes
     */
    public function it_can_generate_random_enum_instances(): void
    {
        $enum = $this->faker->randomEnum(RandomizedEnum::class);

        $this->assertInstanceOf(RandomizedEnum::class, $enum);
    }

    /**
     * @test
     * @dataProvider repeatHundredTimes
     */
    public function it_can_generate_random_enum_values(): void
    {
        $value = $this->faker->randomEnumValue(RandomizedEnum::class);

        $this->assertIsString($value);
        $this->assertInstanceOf(RandomizedEnum::class, RandomizedEnum::make($value));
        $this->assertTrue(in_array($value, RandomizedEnum::toValues(), true));
    }

    /**
     * @test
     * @dataProvider repeatHundredTimes
     */
    public function it_can_generate_random_enum_labels(): void
    {
        $label = $this->faker->randomEnumLabel(RandomizedEnum::class);

        $this->assertIsString($label);
        $this->assertInstanceOf(RandomizedEnum::class, RandomizedEnum::make($label));
        $this->assertTrue(in_array($label, RandomizedEnum::toLabels(), true));
    }

    public function repeatHundredTimes(): iterable
    {
        for ($i = 0; $i < 100; $i++) {
            yield [];
        }
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class RandomizedEnum extends Enum
{
}

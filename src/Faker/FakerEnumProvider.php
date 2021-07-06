<?php

namespace Spatie\Enum\Faker;

use Faker\Provider\Base;
use Spatie\Enum\Enum;
use UnitEnum;
use BackedEnum;

class FakerEnumProvider extends Base
{
    /**
     * A random instance of the enum you pass in.
     *
     * @param string $enum
     * @psalm-param class-string $enum
     *
     * @return \UnitEnum
     */
    public function randomEnum(string $enum): UnitEnum
    {
        return static::randomElement($enum::cases());
    }

    /**
     * A random value of the enum you pass in.
     *
     * @param string $enum
     * @psalm-param class-string $enum
     *
     * @return string|int
     */
    public function randomEnumValue(string $enum): string|int
    {
        return static::randomElement($enum::values());
    }

    /**
     * A random label of the enum you pass in.
     *
     * @param string $enum
     * @psalm-param class-string $enum
     *
     * @return string
     */
    public function randomEnumLabel(string $enum): string
    {
        return static::randomElement($enum::labels());
    }
}

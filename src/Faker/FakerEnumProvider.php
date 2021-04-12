<?php

namespace Spatie\Enum\Faker;

use Faker\Provider\Base;
use InvalidArgumentException;
use Spatie\Enum\Enum;
use UnitEnum;
use BackedEnum;

class FakerEnumProvider extends Base
{
    /**
     * A random instance of the enum you pass in.
     *
     * @param string $enum
     *
     * @return \UnitEnum
     */
    public function randomEnum(string $enum): UnitEnum
    {
        if (! array_key_exists(UnitEnum::class, class_implements($enum))) {
            throw new InvalidArgumentException(sprintf(
                'You have to pass the FQCN of a "%s" class but you passed "%s".',
                UnitEnum::class,
                $enum
            ));
        }

        return static::randomElement($enum::cases());
    }

    /**
     * A random value of the enum you pass in.
     *
     * @param string $enum
     *
     * @return string|int
     */
    public function randomEnumValue(string $enum): string|int
    {
        if (! array_key_exists(BackedEnum::class, class_implements($enum))) {
            throw new InvalidArgumentException(sprintf(
                'You have to pass the FQCN of a "%s" class but you passed "%s".',
                BackedEnum::class,
                $enum
            ));
        }

        return static::randomElement($enum::toValues());
    }

    /**
     * A random label of the enum you pass in.
     *
     * @param string $enum
     *
     * @return string
     */
    public function randomEnumLabel(string $enum): string
    {
        if (! array_key_exists(UnitEnum::class, class_implements($enum))) {
            throw new InvalidArgumentException(sprintf(
                'You have to pass the FQCN of a "%s" class but you passed "%s".',
                UnitEnum::class,
                $enum
            ));
        }

        return static::randomElement($enum::toLabels());
    }
}

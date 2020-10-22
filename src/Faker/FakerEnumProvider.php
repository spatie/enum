<?php

namespace Spatie\Enum\Faker;

use Faker\Provider\Base;
use InvalidArgumentException;
use Spatie\Enum\Enum;

class FakerEnumProvider extends Base
{
    /**
     * A random instance of the enum you pass in.
     *
     * @param string $enum
     *
     * @return Enum
     */
    public function randomEnum(string $enum): Enum
    {
        $this->checkEnum($enum);

        return $enum::make(static::randomElement(array_keys($enum::toArray())));
    }

    /**
     * A random value of the enum you pass in.
     *
     * @param string $enum
     *
     * @return string|int
     */
    public function randomEnumValue(string $enum)
    {
        $this->checkEnum($enum);

        return static::randomElement(array_keys($enum::toArray()));
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
        $this->checkEnum($enum);

        return static::randomElement(array_values($enum::toArray()));
    }

    protected function checkEnum(string $enum): void
    {
        if (! is_subclass_of($enum, Enum::class)) {
            throw new InvalidArgumentException(sprintf(
                'You have to pass the FQCN of a "%s" class but you passed "%s".',
                Enum::class,
                $enum
            ));
        }
    }
}

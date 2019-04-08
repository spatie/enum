<?php

namespace Spatie\Enum;

use Spatie\Enum\Exceptions\InvalidEnumError;
use Spatie\Enum\Exceptions\InvalidValueException;

trait HasEnums
{
    /**
     * @param $key
     * @param \Spatie\Enum\Enum $enumObject
     *
     * @return mixed
     */
    public function setAttribute($key, $enumObject)
    {
        if (! isset($this->enums[$key])) {
            return parent::setAttribute($key, $enumObject);
        }

        $enumClass = $this->enums[$key];

        if (! is_a($enumObject, $enumClass)) {
            throw InvalidEnumError::make(
                static::class,
                $key,
                $enumClass,
                get_class($enumObject)
            );
        }

        $enumValue = $enumObject->getValue();

        $mappedValue = $enumClass::$map[$enumValue] ?? null;

        $this->attributes[$key] = $mappedValue ?? $enumValue;

        return $this;
    }

    public function getAttribute($key)
    {
        if (! isset($this->enums[$key])) {
            return parent::getAttribute($key);
        }

        $enumClass = $this->enums[$key];

        $storedEnumValue = $this->attributes[$key] ?? null;

        try {
            $enumObject = forward_static_call_array(
                $enumClass . '::make',
                [$storedEnumValue]
            );
        } catch (InvalidValueException $exception) {
            $mappedEnumValue = array_search($storedEnumValue, $enumClass::$map ?? []);

            if (! $mappedEnumValue) {
                throw new InvalidValueException($storedEnumValue, $enumClass);
            }

            $enumObject = forward_static_call_array(
                $enumClass . '::make',
                [$mappedEnumValue]
            );
        }

        return $enumObject;
    }
}

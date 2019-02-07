<?php

namespace Spatie\Enum;

use ReflectionClass;
use TypeError;

abstract class Enum
{
    protected static $enumValues = null;

    /** @var string */
    protected $value;

    public static function from(string $value): Enum
    {
        return new static($value);
    }

    public function __construct(?string $value)
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        if (! in_array($value, self::$enumValues)) {
            throw new TypeError("Value {$value} not available in enum " . static::class);
        }

        $this->value = $value;
    }

    public static function __callStatic($name, $arguments): Enum
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        if (! isset(self::$enumValues[$name])) {
            throw new TypeError("Method {$name} not available in enum " . static::class);
        }

        return new static(self::$enumValues[$name]);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Enum $enum): bool
    {
        return $enum instanceof $this
            && $enum->value === $this->value;
    }

    public static function toArray(): array
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        return self::$enumValues;
    }

    protected static function resolveEnumValues()
    {
        $reflection = new ReflectionClass(static::class);

        $docComment = $reflection->getDocComment();

        preg_match_all('/\@method static self ([\w]+)\(\)\s([\w ]+)?/', $docComment, $enumValues);

        foreach ($enumValues[1] ?? [] as $index => $enumValue) {
            $valueName = $enumValues[1][$index];

            $value = trim($enumValues[2][$index]);

            if (! $value) {
                $value = $valueName;
            }

            self::$enumValues[$valueName] = $value;
        }
    }
}

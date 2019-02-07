<?php

namespace Spatie\Enum;

use ReflectionClass;
use TypeError;

abstract class Enum
{
    protected static $enumValues = null;

    /** @var string */
    protected $value;

    protected function __construct(?string $value)
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        if (! in_array($value, self::$enumValues)) {
            throw new TypeError("Value {$value} not available in enum " . static::class);
        }

        $this->value = $value;
    }

    public static function __callStatic($name, $arguments)
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        $value = self::$enumValues[$name] ?? null;

        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
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

<?php

namespace Spatie\Enum;

use ReflectionClass;
use TypeError;

abstract class Enum
{
    private static $enumValues = null;

    /** @var string */
    protected $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function __callStatic($name, $arguments)
    {
        if (self::$enumValues === null) {
            self::resolveEnumValues();
        }

        $value = self::$enumValues[$name] ?? null;

        if ($value === null) {
            throw new TypeError('Enum ' . static::class . " has no value {$name}");
        }

        return new static($value);
    }

    private static function resolveEnumValues(): void
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

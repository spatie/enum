<?php

namespace Spatie\Enum;

use ReflectionClass;
use TypeError;

abstract class Enum
{
    private static $enumValues = null;

    /** @var string */
    private $value;

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
            $reflection = new ReflectionClass(static::class);

            $docComment = $reflection->getDocComment();

            preg_match_all('/\@method static ([\w]+)\(\)/', $docComment, $enumValues);

            $enumValues = $enumValues[1] ?? [];

            foreach ($enumValues as $enumValue) {
                self::$enumValues[$enumValue] = $enumValue;
            }
        }

        $value = self::$enumValues[$name] ?? null;

        if ($value === null) {
            throw new TypeError('Enum ' . static::class . " has no value {$name}");
        }

        return new static($value);
    }
}

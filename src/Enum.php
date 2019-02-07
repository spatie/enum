<?php

namespace Spatie\Enum;

use TypeError;
use ReflectionClass;

abstract class Enum
{
    /** @var array */
    protected static $cache = [];

    /** @var array */
    protected static $map = [];

    /** @var string */
    protected $value;

    public static function from(string $value): Enum
    {
        return new static($value);
    }

    public function __construct(string $value = null)
    {
        if (! in_array($value, self::resolve())) {
            throw new TypeError("Value {$value} not available in enum ".static::class);
        }

        $this->value = $value;
    }

    public static function __callStatic($name, $arguments): Enum
    {
        $enumValues = self::resolve();

        if (! isset($enumValues[$name])) {
            throw new TypeError("Method {$name} not available in enum ".static::class);
        }

        return new static($enumValues[$name]);
    }

    public function equals(Enum $enum): bool
    {
        if (! $enum instanceof $this) {
            return false;
        }

        if ($enum->value !== $this->value) {
            return false;
        }

        return true;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return self::resolve();
    }

    protected static function resolve(): array
    {
        $class = static::class;

        if (isset(self::$cache[$class])) {
            return self::$cache[$class];
        }

        $reflection = new ReflectionClass(static::class);

        $docComment = $reflection->getDocComment();

        preg_match_all('/\@method static self ([\w]+)\(\)/', $docComment, $matches);

        $enumValues = [];

        foreach ($matches[1] ?? [] as $valueName) {
            $enumValues[$valueName] = static::$map[$valueName] ?? $valueName;
        }

        self::$cache[$class] = $enumValues;

        return self::$cache[$class];
    }
}

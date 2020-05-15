<?php

namespace Spatie\Enum;

use BadMethodCallException;
use ReflectionClass;

/**
 * @property-read string value
 * @property-read string label
 */
abstract class Enum
{
    protected string $value;

    protected string $label;

    private static array $definitionCache = [];

    public static function toArray(): array
    {
        return static::resolveDefinition();
    }

    public function __construct(string $value)
    {
        $definition = static::resolveDefinition();

        if (! isset($definition[$value])) {
            $enumClass = static::class;

            throw new BadMethodCallException("There's no value {$value} defined for enum {$enumClass}, consider adding it in the docblock definition.");
        }

        $this->value = $value;
        $this->label = $definition[$value];
    }

    public function __get($name)
    {
        if ($name === 'label') {
            return $this->label;
        }

        if ($name === 'value') {
            return $this->value;
        }
    }

    public static function __callStatic(string $name, array $arguments)
    {
        return new static($name);
    }

    public function equalsAny(Enum ...$others): bool
    {
        foreach ($others as $other) {
            if ($this->equals($other)) {
                return true;
            }
        }

        return false;
    }

    public function equals(Enum $other): bool
    {
        return get_class($this) === get_class($other)
            && $this->value === $other->value;
    }

    protected static function labels(): array
    {
        return [];
    }

    private static function resolveDefinition(): array
    {
        $className = static::class;

        if (static::$definitionCache[$className] ?? null) {
            return static::$definitionCache[$className];
        }

        $reflectionClass = new ReflectionClass($className);

        $docComment = $reflectionClass->getDocComment();

        preg_match_all('/@method static self ([\w_]+)\(\)/', $docComment, $matches);

        $definition = [];

        $labels = static::labels();

        foreach ($matches[1] as $value) {
            $definition[$value] = $labels[$value] ?? $value;
        }

        return static::$definitionCache[$className] ??= $definition;
    }
}

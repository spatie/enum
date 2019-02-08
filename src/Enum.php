<?php

namespace Spatie\Enum;

use JsonSerializable;
use ReflectionMethod;
use TypeError;
use ReflectionClass;

abstract class Enum implements JsonSerializable
{
    /** @var array */
    protected static $cache = [];

    /** @var array */
    protected static $map = [];

    /** @var string */
    protected $value;

    public static function from(string $value): Enum
    {
        if (method_exists(static::class, $value)) {
            return forward_static_call(static::class . '::' . $value);
        }

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

    /**
     * @param string|\Spatie\Enum\Enum $enum
     *
     * @return bool
     */
    public function equals($enum): bool
    {
        if (is_string($enum)) {
            $enum = static::from($enum);
        }

        if (! $enum instanceof $this) {
            return false;
        }

        if ($enum->value !== $this->value) {
            return false;
        }

        return true;
    }

    public function isOneOf(array $enums): bool
    {
        /** @var \Spatie\Enum\Enum $enum */
        foreach ($enums as $enum) {
            if ($this->equals($enum)) {
                return true;
            }
        }

        return false;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function jsonSerialize()
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

        $enumValues = [];

        $staticReflection = new ReflectionClass(static::class);

        foreach (self::resolveValuesFromStaticMethods($staticReflection) as $value => $name) {
            $enumValues[$value] = $name;
        }

        foreach (self::resolveFromDocblocks($staticReflection) as $value => $name) {
            $enumValues[$value] = $name;
        }

        self::$cache[$class] = $enumValues;

        return self::$cache[$class];
    }

    protected static function resolveValuesFromStaticMethods(ReflectionClass $staticReflection): array
    {
        $enumValues = [];

        $selfReflection = new ReflectionClass(self::class);

        $selfStaticMethods = [];

        foreach ($selfReflection->getMethods(ReflectionMethod::IS_STATIC) as $method) {
            $selfStaticMethods[$method->name] = $method->name;
        }

        foreach ($staticReflection->getMethods(ReflectionMethod::IS_STATIC) as $method) {
            $methodName = $method->getName();

            if (isset($selfStaticMethods[$methodName])) {
                continue;
            }

            $enumValues[$methodName] = static::$map[$methodName] ?? $methodName;
        }

        return $enumValues;
    }

    protected static function resolveFromDocblocks(ReflectionClass $staticReflection): array
    {
        $enumValues = [];

        $docComment = $staticReflection->getDocComment();

        preg_match_all('/\@method static self ([\w]+)\(\)/', $docComment, $matches);

        foreach ($matches[1] ?? [] as $valueName) {
            $enumValues[$valueName] = static::$map[$valueName] ?? $valueName;
        }

        return $enumValues;
    }
}

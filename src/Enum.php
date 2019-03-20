<?php

declare(strict_types=1);

namespace Spatie\Enum;

use TypeError;
use ReflectionClass;
use JsonSerializable;
use ReflectionMethod;
use BadMethodCallException;
use Spatie\Enum\Exceptions\InvalidIndexException;
use Spatie\Enum\Exceptions\InvalidValueException;

abstract class Enum implements Enumerable, JsonSerializable
{
    /** @var array[] */
    protected static $cache = [];

    /** @var string */
    protected $value;

    /** @var int */
    protected $index;

    public function __construct(?string $value = null, ?int $index = null)
    {
        if (is_null($value) && is_null($index)) {
            $value = $this->resolveValueFromStaticCall();
            $index = static::toArray()[$value];
        }

        if (! static::isValidValue($value)) {
            throw new InvalidValueException($value, static::class);
        }

        if (! static::isValidIndex($index)) {
            throw new InvalidIndexException($value, static::class);
        }

        $this->value = $value;
        $this->index = $index;
    }

    public function __call($name, $arguments)
    {
        if (strlen($name) > 2 && strpos($name, 'is') === 0) {
            return $this->isEqual(substr($name, 2));
        }

        if (static::isValidValue($name)) {
            return static::__callStatic($name, $arguments);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s->%s()', static::class, $name));
    }

    public static function __callStatic($name, $arguments)
    {
        if (strlen($name) > 2 && strpos($name, 'is') === 0) {
            if (! isset($arguments[0])) {
                throw new \ArgumentCountError(sprintf('Calling %s::%s() in static context requires one argument', static::class, $name));
            }

            return static::make($arguments[0])->$name();
        }

        if (static::isValidName($name) || static::isValidValue($name)) {
            return static::make($name);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s::%s()', static::class, $name));
    }

    public static function make($value): Enumerable
    {
        if (is_int($value)) {
            $index = $value;

            if (! static::isValidIndex($index)) {
                throw new InvalidIndexException($value, static::class);
            }

            return new static(array_search($index, static::toArray()), $index);
        } elseif (is_string($value)) {
            if (method_exists(static::class, $value)) {
                return forward_static_call(static::class.'::'.$value);
            }

            if (static::isValidValue($value)) {
                return new static($value, static::toArray()[$value]);
            }

            if (static::isValidName($value)) {
                $value = strtoupper($value);

                return new static(static::resolve()[$value]['value'], static::resolve()[$value]['index']);
            }

            throw new InvalidValueException($value, static::class);
        }

        throw new TypeError(sprintf('%s::make() expects string|int as argument but %s given', static::class, gettype($value)));
    }

    public static function isValidIndex(int $index): bool
    {
        return in_array($index, static::getIndices(), true);
    }

    public static function isValidName(string $value): bool
    {
        return in_array(strtoupper($value), array_keys(static::resolve()), true);
    }

    public static function isValidValue(string $value): bool
    {
        return in_array($value, static::getValues(), true);
    }

    public static function getIndices(): array
    {
        return array_values(static::toArray());
    }

    public static function getValues(): array
    {
        return array_keys(static::toArray());
    }

    public static function toArray(): array
    {
        $resolved = static::resolve();

        return array_combine(array_column($resolved, 'value'), array_column($resolved, 'index'));
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function isEqual($value): bool
    {
        if (is_string($value)) {
            $enum = static::make($value);
        } elseif ($value instanceof $this) {
            $enum = $value;
        }

        if (
            isset($enum)
            && $enum instanceof $this
            && $enum->getValue() === $this->getValue()
        ) {
            return true;
        }

        return false;
    }

    public function isAny(array $values): bool
    {
        foreach ($values as $value) {
            if ($this->isEqual($value)) {
                return true;
            }
        }

        return false;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function jsonSerialize()
    {
        return $this->getValue();
    }

    protected static function resolve(): array
    {
        $values = [];

        $class = static::class;

        if (isset(self::$cache[$class])) {
            return self::$cache[$class];
        }

        self::$cache[$class] = [];

        $reflection = new ReflectionClass(static::class);

        foreach (self::resolveFromDocBlocks($reflection) as $value) {
            $values[] = $value;
        }

        foreach (self::resolveFromStaticMethods($reflection) as $value) {
            $values[] = $value;
        }

        foreach ($values as $index => $value) {
            self::$cache[$class][strtoupper($value)] = [
                'index' => $index,
                'value' => $value,
            ];
        }

        foreach (self::$cache[$class] as $name => $enum) {
            self::$cache[$class][$name]['value'] = static::make($name)->getValue();
            self::$cache[$class][$name]['index'] = static::make($name)->getIndex();
        }

        return self::$cache[$class];
    }

    protected static function resolveFromStaticMethods(ReflectionClass $reflection): array
    {
        $values = [];
        foreach ($reflection->getMethods(ReflectionMethod::IS_STATIC) as $method) {
            if ($method->getDeclaringClass()->getName() === self::class) {
                continue;
            }

            $values[] = $method->getName();
        }

        return $values;
    }

    protected static function resolveFromDocBlocks(ReflectionClass $reflection): array
    {
        $values = [];

        $docComment = $reflection->getDocComment();

        if (! $docComment) {
            return $values;
        }

        preg_match_all('/\@method static self ([\w]+)\(\)/', $docComment, $matches);

        foreach ($matches[1] ?? [] as $value) {
            $values[] = $value;
        }

        return $values;
    }

    protected function resolveValueFromStaticCall(): string
    {
        $value = null;

        if (strpos(get_class($this), 'class@anonymous') === 0) {
            $backtrace = debug_backtrace();

            $value = $backtrace[2]['function'];

            if (static::isValidValue($value)) {
                return $value;
            }
        }

        throw new InvalidValueException($value, static::class);
    }
}

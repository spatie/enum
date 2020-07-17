<?php

namespace Spatie\Enum;

use ArgumentCountError;
use BadMethodCallException;
use JsonSerializable;
use ReflectionClass;
use ReflectionMethod;
use Spatie\Enum\Exceptions\DuplicatedIndexException;
use Spatie\Enum\Exceptions\DuplicatedValueException;
use Spatie\Enum\Exceptions\InvalidIndexException;
use Spatie\Enum\Exceptions\InvalidNameException;
use Spatie\Enum\Exceptions\InvalidValueException;
use TypeError;

abstract class Enum implements Enumerable, JsonSerializable
{
    /** @var array[] */
    protected static $cache = [];

    /** @var int */
    protected $index;

    /** @var string */
    protected $value;

    /** @var string */
    protected $name;

    /**
     * This construct is not part of the public API and COULD change in a minor release.
     * You SHOULD NOT use it by your own - instead you SHOULD use the make() method.
     *
     * @internal
     * @see \Spatie\Enum\Enum::make()
     *
     * @param string|null $name
     * @param string|null $value
     * @param int|null $index
     */
    public function __construct(?string $name = null, ?string $value = null, ?int $index = null)
    {
        if (is_null($name) && is_null($value) && is_null($index)) {
            ['name' => $name, 'value' => $value, 'index' => $index] = $this->resolveByStaticCall();
        }

        if (is_null($name) || ! static::isValidName($name)) {
            throw new InvalidNameException($name, static::class);
        }

        if (is_null($value) || ! static::isValidValue($value)) {
            throw new InvalidValueException($value, static::class);
        }

        if (is_null($index) || ! static::isValidIndex($index)) {
            throw new InvalidIndexException($index, static::class);
        }

        $this->name = $name;
        $this->value = $value;
        $this->index = $index;
    }

    public function __call(string $name, array $arguments)
    {
        if (static::startsWith($name, 'is')) {
            return $this->isEqual(substr($name, 2));
        }

        if (static::isValidName($name)) {
            return static::make($name);
        }

        throw new BadMethodCallException('Call to undefined method '.static::class.'->'.$name.'()');
    }

    /**
     * @param string $name
     * @param mixed[] $arguments
     *
     * @return \Spatie\Enum\Enumerable|bool
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (static::startsWith($name, 'is')) {
            if (! isset($arguments[0])) {
                throw new ArgumentCountError('Calling '.static::class.'::'.$name.'() in static context requires one argument');
            }

            try {
                return static::make($arguments[0])->$name();
            } catch (InvalidValueException $error) {
                return false;
            } catch (InvalidIndexException $error) {
                return false;
            }
        }

        if (static::isValidName($name) || static::isValidValue($name)) {
            return static::make($name);
        }

        throw new BadMethodCallException('Call to undefined method '.static::class.'::'.$name.'()');
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public static function getIndices(): array
    {
        return array_column(static::resolve(), 'index');
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function getValues(): array
    {
        return array_column(static::resolve(), 'value');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public static function getNames(): array
    {
        return array_keys(static::resolve());
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

    public function isEqual($value): bool
    {
        if (is_int($value) || is_string($value)) {
            try {
                $value = static::make($value);
            } catch (InvalidValueException $error) {
                return false;
            } catch (InvalidIndexException $error) {
                return false;
            }
        }

        if ($value instanceof $this) {
            return $value->getValue() === $this->getValue();
        }

        return false;
    }

    public function jsonSerialize(): string
    {
        return $this->getValue();
    }

    /**
     * @param int|string $value
     *
     * @return static
     */
    public static function make($value): Enumerable
    {
        if (! is_int($value) && ! is_string($value)) {
            throw new TypeError(static::class.'::make() expects string|int as argument but '.gettype($value).' given');
        }

        $name = null;
        $index = null;

        if (is_int($value)) {
            if (! static::isValidIndex($value)) {
                throw new InvalidIndexException($value, static::class);
            }

            [$name, $index, $value] = static::resolveByIndex($value);
        } elseif (is_string($value)) {
            [$name, $index, $value] = static::resolveByString($value);
        }

        if (is_string($name) && method_exists(static::class, $name)) {
            return forward_static_call(static::class.'::'.$name);
        }

        return new static($name, $value, $index);
    }

    public static function toArray(): array
    {
        return array_combine(static::getValues(), static::getIndices());
    }

    /**
     * @return \Spatie\Enum\Enumerable[]
     */
    public static function getAll(): array
    {
        return array_map(static function (int $index): Enumerable {
            return static::make($index);
        }, static::getIndices());
    }

    public static function isValidIndex(int $index): bool
    {
        return in_array($index, static::getIndices(), true);
    }

    public static function isValidName(string $value): bool
    {
        return in_array(strtoupper($value), static::getNames(), true);
    }

    public static function isValidValue(string $value): bool
    {
        return in_array($value, static::getValues(), true);
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

        foreach (static::resolveFromDocBlocks($reflection) as $value) {
            $values[] = $value;
        }

        foreach (static::resolveFromStaticMethods($reflection) as $value) {
            $values[] = $value;
        }

        foreach ($values as $index => $value) {
            $name = strtoupper($value);

            self::$cache[$class][$name] = [
                'name' => $name,
                'index' => static::getMappedIndex($name) ?? $index,
                'value' => static::getMappedValue($name) ?? $value,
            ];
        }

        foreach (array_keys(self::$cache[$class]) as $name) {
            self::$cache[$class][$name]['value'] = static::make($name)->getValue();
            self::$cache[$class][$name]['index'] = static::make($name)->getIndex();
        }

        $duplicatedValues = array_filter(array_count_values(static::getValues()), static function (int $count): bool {
            return $count > 1;
        });

        if (! empty($duplicatedValues)) {
            self::clearCache();
            throw new DuplicatedValueException(array_keys($duplicatedValues), static::class);
        }

        $duplicatedIndices = array_filter(array_count_values(static::getIndices()), static function (int $count): bool {
            return $count > 1;
        });

        if (! empty($duplicatedIndices)) {
            self::clearCache();
            throw new DuplicatedIndexException(array_keys($duplicatedIndices), static::class);
        }

        return self::$cache[$class];
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

    protected static function resolveFromStaticMethods(ReflectionClass $reflection): array
    {
        $selfReflection = new ReflectionClass(self::class);
        $selfMethods = array_map(static function (ReflectionMethod $method): string {
            return $method->getName();
        }, $selfReflection->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC));

        $values = [];
        foreach ($reflection->getMethods(ReflectionMethod::IS_STATIC | ReflectionMethod::IS_PUBLIC) as $method) {
            if (
                $method->getDeclaringClass()->getName() === self::class
                || ! ($method->isPublic() && $method->isStatic())
                || in_array($method->getName(), $selfMethods)
            ) {
                continue;
            }

            $values[] = $method->getName();
        }

        return $values;
    }

    protected function resolveByStaticCall(): array
    {
        if (strpos(static::class, 'class@anonymous') !== 0) {
            throw new InvalidValueException(null, static::class);
        }

        $backtrace = debug_backtrace();

        $name = $backtrace[2]['function'];

        if (! static::isValidName($name)) {
            throw new InvalidValueException($name, static::class);
        }

        return static::resolve()[strtoupper($name)];
    }

    protected static function resolveByIndex(int $index): array
    {
        $name = array_combine(static::getIndices(), static::getNames())[$index];

        return static::resolveByName($name);
    }

    protected static function resolveByString(string $string): array
    {
        if (static::isValidValue($string)) {
            return static::resolveByValue($string);
        }

        if (static::isValidName($string)) {
            return static::resolveByName($string);
        }

        throw new InvalidValueException($string, static::class);
    }

    protected static function resolveByValue(string $value): array
    {
        $name = array_combine(static::getValues(), static::getNames())[$value];

        return static::resolveByName($name);
    }

    protected static function resolveByName(string $name): array
    {
        $name = strtoupper($name);

        ['value' => $value, 'index' => $index] = static::resolve()[$name];

        return [$name, $index, $value];
    }

    protected static function startsWith(string $haystack, string $needle): bool
    {
        return strlen($haystack) > 2 && strpos($haystack, $needle) === 0;
    }

    protected static function clearCache(): void
    {
        unset(self::$cache[static::class]);
    }

    protected static function getMappedIndex(string $name): ?int
    {
        if (! defined(static::class.'::MAP_INDEX')) {
            return null;
        }

        $map = [];

        foreach (constant(static::class.'::MAP_INDEX') as $key => $index) {
            $map[strtoupper($key)] = $index;
        }

        return $map[$name] ?? null;
    }

    protected static function getMappedValue(string $name): ?string
    {
        if (! defined(static::class.'::MAP_VALUE')) {
            return null;
        }

        $map = [];

        foreach (constant(static::class.'::MAP_VALUE') as $key => $index) {
            $map[strtoupper($key)] = $index;
        }

        return $map[$name] ?? null;
    }
}

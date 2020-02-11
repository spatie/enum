<?php

namespace Spatie\Enum;

interface Enumerable
{
    /**
     * Cast the current instance to string and get the value.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Get the current index.
     *
     * @return int
     */
    public function getIndex(): int;

    /**
     * Get all indices as array.
     *
     * @return int[]
     */
    public static function getIndices(): array;

    /**
     * Get the current value.
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Get all values as array.
     *
     * @return string[]
     */
    public static function getValues(): array;

    /**
     * Get all enumerables as array.
     *
     * @return \Spatie\Enum\Enumerable[]
     */
    public static function getAll(): array;

    /**
     * Get the current name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get all names as array.
     *
     * @return string[]
     */
    public static function getNames(): array;

    /**
     * Check if the current instance is equal with one of the given values.
     *
     * @param string[]|int[]|\Spatie\Enum\Enumerable[]|mixed[] $values
     *
     * @return bool
     */
    public function isAny(array $values): bool;

    /**
     * Check if the current instance and the given value are equal.
     *
     * @param string|int|\Spatie\Enum\Enumerable|mixed $value
     *
     * @return bool
     */
    public function isEqual($value): bool;

    /**
     * Create a valued instance of the Enum by it's value or index.
     *
     * @param string|int $value
     *
     * @return \Spatie\Enum\Enumerable
     */
    public static function make($value): Enumerable;

    /**
     * Get the whole enum as array.
     * value => index.
     *
     * @return array
     */
    public static function toArray(): array;

    /**
     * Check if the given index is a valid one.
     *
     * @param int $index
     *
     * @return bool
     */
    public static function isValidIndex(int $index): bool;

    /**
     * Check if the given name is a valid one.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function isValidName(string $name): bool;

    /**
     * Check if the given value is a valid one.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function isValidValue(string $value): bool;
}

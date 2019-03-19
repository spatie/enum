<?php

namespace Spatie\Enum;

interface Enumerable
{
    /**
     * Create a valued instance of the Enum by it's value or index.
     *
     * @param string|int $value
     *
     * @return \Spatie\Enum\Enumerable
     */
    public static function make($value): Enumerable;

    /**
     * Check if the current instance and the given value are equal.
     *
     * @param string|\Spatie\Enum\Enumerable $value
     *
     * @return bool
     */
    public function isEqual($value): bool;

    /**
     * Check if the current instance is equal with one of the given values.
     *
     * @param string[]|\Spatie\Enum\Enumerable[] $values
     *
     * @return bool
     */
    public function isAny(array $values): bool;

    /**
     * Check if the given index exists on this enum.
     *
     * @param int $index
     *
     * @return bool
     */
    public static function isIndex(int $index): bool;

    /**
     * Check if the given value exists on this enum.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function isValue(string $value): bool;

    /**
     * Get the current index.
     *
     * @return int
     */
    public function getIndex(): int;

    /**
     * Get the current value.
     *
     * @return string
     */
    public function getValue(): string;

    /**
     * Get the whole enum as array.
     * value => index.
     *
     * @return array
     */
    public static function toArray(): array;

    /**
     * Get all values as array.
     *
     * @return string[]
     */
    public static function getValues(): array;

    /**
     * Get all indices as array.
     *
     * @return int[]
     */
    public static function getIndices(): array;

    /**
     * Cast the current instance to string and get the value.
     *
     * @return string
     */
    public function __toString(): string;
}

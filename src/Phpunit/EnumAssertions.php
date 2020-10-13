<?php

namespace Spatie\Enum\Phpunit;

use BadMethodCallException;
use PHPUnit\Framework\Assert as PHPUnit;
use Spatie\Enum\Enum;
use TypeError;

trait EnumAssertions
{
    /**
     * @param Enum|mixed $actual
     * @param string|null $message
     */
    public static function assertIsEnum($actual, ?string $message = null): void
    {
        PHPUnit::assertInstanceOf(
            Enum::class,
            $actual,
            $message ?? ''
        );
    }

    /**
     * @param Enum $expected
     * @param Enum|string|int|mixed $actual
     * @param string|null $message
     */
    public static function assertEqualsEnum(Enum $expected, $actual, ?string $message = null): void
    {
        try {
            $enum = static::asEnum($actual, $expected);

            PHPUnit::assertTrue(
                $expected->equals($enum),
                $message ?? ''
            );
        } catch (TypeError $ex) {
            PHPUnit::assertTrue(false, $ex->getMessage());
        } catch (BadMethodCallException $ex) {
            PHPUnit::assertTrue(false, $ex->getMessage());
        }
    }

    /**
     * @param Enum $expected
     * @param Enum|mixed $actual
     * @param string|null $message
     */
    public static function assertSameEnum(Enum $expected, $actual, ?string $message = null): void
    {
        static::assertIsEnum($actual);

        PHPUnit::assertTrue(
            $expected->equals($actual),
            $message ?? ''
        );
    }

    /**
     * @param Enum $expected
     * @param string|int|mixed $actual
     * @param string|null $message
     */
    public static function assertSameEnumValue(Enum $expected, $actual, ?string $message = null): void
    {
        PHPUnit::assertSame(
            $expected->value,
            $actual,
            $message ?? ''
        );
    }

    /**
     * @param Enum $expected
     * @param string|mixed $actual
     * @param string|null $message
     */
    public static function assertSameEnumLabel(Enum $expected, $actual, ?string $message = null): void
    {
        PHPUnit::assertSame(
            $expected->label,
            $actual,
            $message ?? ''
        );
    }

    /**
     * @param int|string|Enum $value
     * @param Enum $enum
     *
     * @return Enum
     *
     * @throws TypeError
     * @throws BadMethodCallException
     *
     * @see \Spatie\Enum\Enum::make()
     */
    protected static function asEnum($value, Enum $enum): Enum
    {
        if ($value instanceof Enum) {
            return $value;
        }

        return forward_static_call(
            [get_class($enum), 'make'],
            $value
        );
    }
}

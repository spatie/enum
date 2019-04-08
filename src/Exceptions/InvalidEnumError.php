<?php

namespace Spatie\Enum\Exceptions;

use TypeError;

final class InvalidEnumError extends TypeError
{
    public static function make(
        string $class,
        string $field,
        string $expected,
        string $got
    ): InvalidEnumError {
        return new self("Expected {$class}::{$field} to be instance of {$expected}, instead got {$got}");
    }
}

<?php

namespace Spatie\Enum\Exceptions;

use Exception;

class UnknownEnumProperty extends Exception
{
    public static function new(string $enumClass, string $name): self
    {
        return new self("Property {$name} not found on class {$enumClass}");
    }
}

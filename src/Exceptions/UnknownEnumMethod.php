<?php

namespace Spatie\Enum\Exceptions;

use Exception;

class UnknownEnumMethod extends Exception
{
    public static function new(string $enumClass, string $name): self
    {
        return new self("Method {$name} not found on class {$enumClass}");
    }
}

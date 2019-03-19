<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class InvalidValueException extends InvalidArgumentException
{
    public function __construct($value, string $class)
    {
        if(is_string($value)) {
            $message = sprintf('The given value [%s] is not available in this enum %s', $value, $class);
        } else {
            $message = sprintf('The value for an enum must be a string but %s given', gettype($value));
        }


        parent::__construct($message);
    }
}

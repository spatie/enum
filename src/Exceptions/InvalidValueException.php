<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class InvalidValueException extends InvalidArgumentException
{
    public function __construct($value, string $class)
    {
        $message = 'The value for an enum must be a string but '.gettype($value).' given';

        if (is_string($value)) {
            $message = 'The given value ['.$value.'] is not available in this enum '.$class;
        }

        parent::__construct($message);
    }
}

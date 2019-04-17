<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class InvalidNameException extends InvalidArgumentException
{
    public function __construct($name, string $class)
    {
        $message = 'The name for an enum must be a string but '.gettype($name).' given';

        if (is_string($name)) {
            $message = 'The given name ['.$name.'] is not available in this enum '.$class;
        }

        parent::__construct($message);
    }
}

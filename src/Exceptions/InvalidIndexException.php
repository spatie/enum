<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class InvalidIndexException extends InvalidArgumentException
{
    public function __construct($index, string $class)
    {
        if(is_int($index)) {
            $message = sprintf('The given index [%d] is not available in this enum %s', $index, $class);
        } else {
            $message = sprintf('The index for an enum must be an int but %s given', gettype($index));
        }


        parent::__construct($message);
    }
}

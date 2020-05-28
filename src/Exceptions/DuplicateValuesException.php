<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicateValuesException extends InvalidArgumentException
{
    public function __construct(string $class)
    {
        parent::__construct("There are duplicated values in the value map of `{$class}::values()`");
    }
}

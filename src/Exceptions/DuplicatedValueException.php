<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicatedValueException extends InvalidArgumentException
{
    public function __construct(array $values, string $class)
    {
        parent::__construct(sprintf('The values ["%s"] are duplicated in enum %s', implode('", "', $values), $class));
    }
}

<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicatedValueException extends InvalidArgumentException
{
    /**
     * @param string[] $values
     * @param string $class
     */
    public function __construct(array $values, string $class)
    {
        parent::__construct('The values ["'.implode('", "', $values).'"] are duplicated in enum '.$class);
    }
}

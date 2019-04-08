<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicatedIndexException extends InvalidArgumentException
{
    public function __construct(array $indices, string $class)
    {
        parent::__construct('The indices ['.implode(', ', $indices).'] are duplicated in enum '.$class);
    }
}

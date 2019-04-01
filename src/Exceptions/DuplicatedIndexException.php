<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicatedIndexException extends InvalidArgumentException
{
    public function __construct(array $indices, string $class)
    {
        parent::__construct(sprintf('The indices [%s] are duplicated in enum %s', implode(', ', $indices), $class));
    }
}

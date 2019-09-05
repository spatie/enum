<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicatedIndexException extends InvalidArgumentException
{
    /**
     * @param int[] $indices
     * @param string $class
     */
    public function __construct(array $indices, string $class)
    {
        parent::__construct('The indices ['.implode(', ', $indices).'] are duplicated in enum '.$class);
    }
}

<?php

namespace Spatie\Enum\Exceptions;

use InvalidArgumentException;

class DuplicateLabelsException extends InvalidArgumentException
{
    public function __construct(string $class)
    {
        parent::__construct("There are duplicated labels in the label map of `{$class}::labels()`");
    }
}

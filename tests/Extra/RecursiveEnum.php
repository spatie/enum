<?php

namespace Spatie\Enum\Tests\Extra;

use Spatie\Enum\Enum;

/**
 * @method static self foo() foovalue
 */
class RecursiveEnum extends Enum
{
    public function __toString(): string
    {
        $values = [
            RecursiveEnum::foo()->value => 'test',
        ];

        return $values[$this->value];
    }
}

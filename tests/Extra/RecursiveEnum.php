<?php

namespace Spatie\Enum\Tests\Extra;

use Spatie\Enum\Enum;

/**
 * @method static self FOO() foovalue
 */
final class RecursiveEnum extends Enum
{
    public function __toString(): string
    {
        $values = [
            RecursiveEnum::FOO()->value => 'test',
        ];

        return $values[$this->value];
    }
}

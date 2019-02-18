<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests\TestClasses;

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

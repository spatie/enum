<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests\TestClasses;

use Spatie\Enum\Enum;

/**
 * @method static self foo()
 */
class RecursiveEnum extends Enum
{
    public function __toString(): string
    {
        $values = [
            RecursiveEnum::foo()->getValue() => 'test',
        ];

        return $values[$this->getValue()];
    }
}

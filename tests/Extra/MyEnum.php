<?php

namespace Spatie\Enum\Tests\Extra;

use Spatie\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 */
class MyEnum extends Enum
{
    protected static function map(): array
    {
        return [
            'foo' => 'foovalue'
        ];
    }
}

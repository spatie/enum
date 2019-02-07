<?php

namespace Spatie\Enum\Tests\Extra;

use Spatie\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 */
class MyEnum extends Enum
{
    protected static $map = [
        'foo' => 'foovalue',
    ];
}

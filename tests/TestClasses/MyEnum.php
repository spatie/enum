<?php

namespace Spatie\Enum\Tests\TestClasses;

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

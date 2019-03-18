<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests\TestClasses;

use Spatie\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 * @method static self Hello()
 * @method static self WORLD()
 */
class MyEnum extends Enum
{
    protected static $map = [
        'foo' => 'foovalue',
        'WORLD' => 'worldvalue',
    ];
}

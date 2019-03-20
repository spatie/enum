<?php

namespace Spatie\Enum\Tests\TestClasses;

use Spatie\Enum\Enum;

/**
 * @method static self draft()
 */
class NumericValuesEnum extends Enum
{
    protected static $map = [
        'draft' => '1',

    ];
}

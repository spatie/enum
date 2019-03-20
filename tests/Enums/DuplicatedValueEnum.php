<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self foo()
 * @method static self bar()
 * @method static self hello()
 * @method static self world()
 * @method static self lorem()
 */
final class DuplicatedValueEnum extends Enum
{
    public function getValue(): string
    {
        switch($this->value) {
            case 'foo':
            case 'bar':
                return 'foobar';
            case 'hello':
            case 'world':
                return 'hello world';
            default:
                return $this->value;
        }
    }
}

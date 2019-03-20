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
final class DuplicatedIndexEnum extends Enum
{
    public function getIndex(): int
    {
        switch ($this->value) {
            case 'foo':
            case 'bar':
                return 1000;
            case 'hello':
            case 'world':
                return 2000;
            default:
                return $this->index;
        }
    }
}

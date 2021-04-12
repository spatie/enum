<?php

namespace Spatie\Enum\Tests;

use Closure;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateLabelsException;

class EnumLabelTest extends TestCase
{
    /** @test */
    public function test_labels_in_to_array()
    {
        $this->assertEquals([
            1,
            2,
        ], EnumWithValues::toValues());
    }

    /** @test */
    public function test_label_on_enum()
    {
        $this->assertEquals('a', EnumWithValues::A->value());
        $this->assertEquals('b', EnumWithValues::B->value());
    }
}

enum EnumWithValues: int
{
    use \Spatie\Enum\Concerns\HasValue;

    case A = 1;
    case B = 2;
}

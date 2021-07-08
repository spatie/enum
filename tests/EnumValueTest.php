<?php

namespace Spatie\Enum\Tests;

use Closure;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateLabelsException;

class EnumValueTest extends TestCase
{
    /** @test */
    public function test_values_in_to_array()
    {
        $this->assertEquals([
            1,
            2,
        ], EnumWithValues::values());
    }

    /** @test */
    public function test_value_on_enum()
    {
        $this->assertSame(1, EnumWithValues::A->value());
        $this->assertSame(2, EnumWithValues::B->value());
    }
}

enum EnumWithValues: int
{
    use \Spatie\Enum\Concerns\HasValue;

    case A = 1;
    case B = 2;
}

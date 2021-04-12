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
            'a',
            'b'
        ], EnumWithLabels::toLabels());
    }

    /** @test */
    public function test_label_on_enum()
    {
        $this->assertEquals('a', EnumWithLabels::A->label());
        $this->assertEquals('b', EnumWithLabels::B->label());
    }
}

enum EnumWithLabels
{
    use \Spatie\Enum\Concerns\HasLabel;

    case A;
    case B;

    public function label(): string
    {
        return match($this) {
            self::A => 'a',
            self::B => 'b',
        };
    }
}

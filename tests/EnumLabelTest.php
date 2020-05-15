<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumLabelTest extends TestCase
{
    /** @test */
    public function test_labels_in_to_array()
    {
        $this->assertEquals([
            'A' => 'a',
            'B' => 'B'
        ], EnumWithLabels::toArray());
    }

    /** @test */
    public function test_label_on_enum()
    {
        $this->assertEquals('a', EnumWithLabels::A()->label);
        $this->assertEquals('B', EnumWithLabels::B()->label);
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithLabels extends Enum
{
    protected static function labels(): array
    {
        return [
            'A' => 'a',
        ];
    }
}

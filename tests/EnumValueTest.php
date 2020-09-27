<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateValuesException;

class EnumValueTest extends TestCase
{
    /** @test */
    public function test_value_on_enum()
    {
        $this->assertEquals(1, EnumWithValues::A()->value);
        $this->assertEquals('B', EnumWithValues::B()->value);
    }

    /** @test */
    public function construct_from_method_name()
    {
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('A')));
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues(1)));
    }

    /** @test */
    public function duplicate_labels_are_not_allowed()
    {
        $this->expectException(DuplicateValuesException::class);

        EnumWithDuplicatedValues::A();
    }

    /** @test */
    public function json_serialize_returns_same_value_type()
    {
        $this->assertSame(1, EnumWithValues::A()->jsonSerialize());
        $this->assertSame('B', EnumWithValues::B()->jsonSerialize());
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithValues extends Enum
{
    protected static function values(): array
    {
        return [
            'A' => 1,
        ];
    }
}

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithDuplicatedValues extends Enum
{
    protected static function values(): array
    {
        return [
            'A' => 1,
            'B' => 1,
        ];
    }
}

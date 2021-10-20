<?php

namespace Spatie\Enum\Tests;

use Closure;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;
use Spatie\Enum\Exceptions\DuplicateValuesException;

class EnumValueTest extends TestCase
{
    /** @test */
    public function test_value_on_enum()
    {
        $this->assertEquals(1, EnumWithValues::A()->value);
        $this->assertEquals(2, EnumWithValues::B()->value);
    }

    /** @test */
    public function construct_from_all_possible_values()
    {
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('A')));
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('a')));
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues('1')));
        $this->assertTrue(EnumWithValues::A()->equals(new EnumWithValues(1)));

        $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('B')));
        $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('b')));
        $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues('2')));
        $this->assertTrue(EnumWithValues::B()->equals(new EnumWithValues(2)));
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
        $this->assertSame(2, EnumWithValues::B()->jsonSerialize());
    }

    /** @test */
    public function it_can_automatically_map_values()
    {
        $this->assertEquals('va', EnumWithAutomaticMappedValues::A()->value);
        $this->assertEquals('vb', EnumWithAutomaticMappedValues::B()->value);
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
            'B' => 2,
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

/**
 * @method static self A()
 * @method static self B()
 */
class EnumWithAutomaticMappedValues extends Enum
{
    protected static function values(): Closure
    {
        return fn (string $name) => 'v'.strtolower($name);
    }
}

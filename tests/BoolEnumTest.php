<?php

namespace Spatie\Enum\OldTests;

use ArgumentCountError;
use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Exceptions\InvalidIndexException;
use Spatie\Enum\Exceptions\InvalidNameException;
use Spatie\Enum\Exceptions\InvalidValueException;
use Spatie\Enum\Tests\Enums\BoolEnum;
use stdClass;
use TypeError;

class BoolEnumTest extends TestCase
{
    /** @test */
    public function it_can_get_all_instances()
    {
        $enums = BoolEnum::getAll();

        $this->assertCount(2, $enums);

        foreach ($enums as $enum) {
            $this->assertInstanceOf(BoolEnum::class, $enum);
        }

        $this->assertEquals('false', $enums[0]->getValue());
        $this->assertEquals('true', $enums[1]->getValue());
    }

    /** @test */
    public function can_create_true_instance_from_doc_tag_name()
    {
        $true = BoolEnum::true();

        $this->assertInstanceOf(BoolEnum::class, $true);
        $this->assertSame(1, $true->getIndex());
        $this->assertTrue(boolval($true->getIndex()));
        $this->assertSame('true', $true->getValue());
        $this->assertEquals('true', $true);
        $this->assertSame('TRUE', $true->getName());
    }

    /** @test */
    public function can_create_true_instance_from_index()
    {
        $true = BoolEnum::make(1);

        $this->assertInstanceOf(BoolEnum::class, $true);
        $this->assertSame(1, $true->getIndex());
        $this->assertTrue(boolval($true->getIndex()));
        $this->assertSame('true', $true->getValue());
        $this->assertEquals('true', $true);
        $this->assertSame('TRUE', $true->getName());
    }

    /** @test */
    public function can_create_false_instance_from_doc_tag_name()
    {
        $false = BoolEnum::false();

        $this->assertInstanceOf(BoolEnum::class, $false);
        $this->assertSame(0, $false->getIndex());
        $this->assertFalse(boolval($false->getIndex()));
        $this->assertSame('false', $false->getValue());
        $this->assertEquals('false', $false);
        $this->assertSame('FALSE', $false->getName());
    }

    /** @test */
    public function can_create_false_instance_from_index()
    {
        $false = BoolEnum::make(0);

        $this->assertInstanceOf(BoolEnum::class, $false);
        $this->assertSame(0, $false->getIndex());
        $this->assertFalse(boolval($false->getIndex()));
        $this->assertSame('false', $false->getValue());
        $this->assertEquals('false', $false);
        $this->assertSame('FALSE', $false->getName());
    }

    /** @test */
    public function can_check_if_value_is_equal_to_defined_one()
    {
        $this->assertTrue(BoolEnum::isTrue('true'));
        $this->assertTrue(BoolEnum::isTrue(1));
        $this->assertFalse(BoolEnum::isTrue('false'));
        $this->assertFalse(BoolEnum::isTrue(0));

        $this->assertTrue(BoolEnum::isFalse('false'));
        $this->assertTrue(BoolEnum::isFalse(0));
        $this->assertFalse(BoolEnum::isFalse('true'));
        $this->assertFalse(BoolEnum::isFalse(1));

        $this->assertTrue(BoolEnum::make('true')->isTrue());
        $this->assertTrue(BoolEnum::make(1)->isTrue());
        $this->assertFalse(BoolEnum::make('false')->isTrue());
        $this->assertFalse(BoolEnum::make(0)->isTrue());

        $this->assertTrue(BoolEnum::make('false')->isFalse());
        $this->assertTrue(BoolEnum::make(0)->isFalse());
        $this->assertFalse(BoolEnum::make('true')->isFalse());
        $this->assertFalse(BoolEnum::make(1)->isFalse());
    }

    /** @test */
    public function can_encode_enum_as_json()
    {
        $true = BoolEnum::true();

        $this->assertSame('"true"', json_encode($true));
    }

    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'false' => 0,
            'true' => 1,
        ], BoolEnum::toArray());
    }

    /** @test */
    public function can_represent_its_names_as_array()
    {
        $this->assertEquals([
            'FALSE',
            'TRUE',
        ], BoolEnum::getNames());
    }

    /** @test */
    public function can_represent_its_values_as_array()
    {
        $this->assertEquals([
            'false',
            'true',
        ], BoolEnum::getValues());
    }

    /** @test */
    public function can_represent_its_indices_as_array()
    {
        $this->assertEquals([
            0,
            1,
        ], BoolEnum::getIndices());
    }

    /** @test */
    public function can_not_create_new_instance_without_arguments()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The value for an enum must be a string but NULL given');

        new BoolEnum();
    }

    /** @test */
    public function can_not_create_new_instance_without_name()
    {
        $this->expectException(InvalidNameException::class);
        $this->expectExceptionMessage('The name for an enum must be a string but NULL given');

        new BoolEnum(null, 'true', 1);
    }

    /** @test */
    public function can_not_create_new_instance_without_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The value for an enum must be a string but NULL given');

        new BoolEnum('TRUE', null, 1);
    }

    /** @test */
    public function can_not_create_new_instance_without_index()
    {
        $this->expectException(InvalidIndexException::class);
        $this->expectExceptionMessage('The index for an enum must be an int but NULL given');

        new BoolEnum('TRUE', 'true', null);
    }

    /** @test */
    public function can_not_create_new_instance_with_invalid_name()
    {
        $this->expectException(InvalidNameException::class);
        $this->expectExceptionMessage('The given name [FOOBAR] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        new BoolEnum('FOOBAR', 'true', 0);
    }

    /** @test */
    public function can_not_create_new_instance_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The given value [foobar] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        new BoolEnum('TRUE', 'foobar', 0);
    }

    /** @test */
    public function can_not_make_new_instance_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The given value [foobar] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        BoolEnum::make('foobar');
    }

    /** @test */
    public function can_not_create_new_instance_with_invalid_index()
    {
        $this->expectException(InvalidIndexException::class);
        $this->expectExceptionMessage('The given index [2] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        new BoolEnum('FALSE', 'false', 2);
    }

    /** @test */
    public function can_not_make_new_instance_with_invalid_index()
    {
        $this->expectException(InvalidIndexException::class);
        $this->expectExceptionMessage('The given index [2] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        BoolEnum::make(2);
    }

    /** @test */
    public function can_not_make_new_instance_with_float()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Spatie\Enum\Tests\Enums\BoolEnum::make() expects string|int as argument but double given');

        BoolEnum::make(2.5);
    }

    /** @test */
    public function can_not_make_new_instance_with_array()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Spatie\Enum\Tests\Enums\BoolEnum::make() expects string|int as argument but array given');

        BoolEnum::make([]);
    }

    /** @test */
    public function can_not_make_new_instance_with_object()
    {
        $this->expectException(TypeError::class);
        $this->expectExceptionMessage('Spatie\Enum\Tests\Enums\BoolEnum::make() expects string|int as argument but object given');

        BoolEnum::make(new stdClass());
    }

    /** @test */
    public function can_not_call_undefined_method()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Call to undefined method Spatie\Enum\Tests\Enums\BoolEnum->foobar()');

        BoolEnum::true()->foobar();
    }

    /** @test */
    public function can_not_call_undefined_static_method()
    {
        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Call to undefined method Spatie\Enum\Tests\Enums\BoolEnum::foobar()');

        BoolEnum::foobar();
    }

    /** @test */
    public function can_not_check_for_static_equality_without_argument()
    {
        $this->expectException(ArgumentCountError::class);
        $this->expectExceptionMessage('Calling Spatie\Enum\Tests\Enums\BoolEnum::isFalse() in static context requires one argument');

        BoolEnum::isFalse();
    }

    /** @test */
    public function can_not_check_for_static_equality_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The given value [foobar] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        BoolEnum::isFalse('foobar');
    }

    /** @test */
    public function can_not_check_for_static_equality_with_invalid_index()
    {
        $this->expectException(InvalidIndexException::class);
        $this->expectExceptionMessage('The given index [2] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        BoolEnum::isFalse(2);
    }

    /** @test */
    public function can_call_public_nonstatic_method()
    {
        $this->assertTrue(BoolEnum::true()->testMethod());
    }
}

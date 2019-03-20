<?php

declare(strict_types=1);

namespace Spatie\Enum\OldTests;

use stdClass;
use TypeError;
use ArgumentCountError;
use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\BoolEnum;
use Spatie\Enum\Exceptions\InvalidIndexException;
use Spatie\Enum\Exceptions\InvalidValueException;

class BoolEnumTest extends TestCase
{
    /** @test */
    public function can_create_true_instance_from_doc_tag_name()
    {
        $true = BoolEnum::true();

        $this->assertInstanceOf(BoolEnum::class, $true);
        $this->assertSame(1, $true->getIndex());
        $this->assertTrue(boolval($true->getIndex()));
        $this->assertSame('true', $true->getValue());
        $this->assertEquals('true', $true);
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
    public function can_not_create_new_instance_without_arguments()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The value for an enum must be a string but NULL given');

        new BoolEnum();
    }

    /** @test */
    public function can_not_create_new_instance_without_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The value for an enum must be a string but NULL given');

        new BoolEnum(null, 1);
    }

    /** @test */
    public function can_not_create_new_instance_without_index()
    {
        $this->expectException(InvalidIndexException::class);
        $this->expectExceptionMessage('The index for an enum must be an int but NULL given');

        new BoolEnum('true');
    }

    /** @test */
    public function can_not_create_new_instance_with_invalid_value()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The given value [foobar] is not available in this enum Spatie\Enum\Tests\Enums\BoolEnum');

        new BoolEnum('foobar', 0);
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

        new BoolEnum('false', 2);
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
}

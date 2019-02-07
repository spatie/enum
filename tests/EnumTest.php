<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Extra\MyEnum;
use TypeError;

class EnumTest extends TestCase
{
    /** @test */
    public function an_enum_can_be_constructed()
    {
        $enumValue = MyEnum::BAR();

        $this->assertInstanceOf(MyEnum::class, $enumValue);
        $this->assertEquals('BAR', $enumValue);
    }

    /** @test */
    public function using_an_invalid_enum_value_throws_a_tyoe_error()
    {
        $this->expectException(TypeError::class);

        MyEnum::WRONG();
    }
}

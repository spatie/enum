<?php

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Enum;

class EnumMethodTest extends TestCase
{
    /** @test */
    public function test()
    {
        $this->assertTrue(MyEnum::FOO()->isFoo());
        $this->assertFalse(MyEnum::BAR()->isFoo());
    }
}

/**
 * @method static self FOO()
 * @method static self BAR()
 */
class MyEnum extends Enum
{
    public function isFoo(): bool
    {
        return $this->isAny([
            self::FOO(),
        ]);
    }
}

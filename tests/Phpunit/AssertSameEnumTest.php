<?php

namespace Spatie\Enum\Tests\Phpunit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

class AssertSameEnumTest extends TestCase
{
    /** @test */
    public function it_passes(): void
    {
        EnumAssertions::assertSameEnum(MyEnum::A(), MyEnum::A());
    }

    /** @test */
    public function it_fails(): void
    {
        $this->expectException(ExpectationFailedException::class);

        EnumAssertions::assertSameEnum(MyEnum::A(), MyEnum::A()->value);
    }
}

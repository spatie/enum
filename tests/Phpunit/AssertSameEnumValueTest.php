<?php

namespace Spatie\Enum\Tests\Phpunit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

class AssertSameEnumValueTest extends TestCase
{
    /** @test */
    public function it_passes(): void
    {
        EnumAssertions::assertSameEnumValue(MyEnum::A(), MyEnum::A()->value);
    }

    /** @test */
    public function it_fails(): void
    {
        $this->expectException(ExpectationFailedException::class);

        EnumAssertions::assertSameEnumValue(MyEnum::A(), MyEnum::A());
    }
}

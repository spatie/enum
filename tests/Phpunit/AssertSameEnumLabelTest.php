<?php

namespace Spatie\Enum\Tests\Phpunit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

class AssertSameEnumLabelTest extends TestCase
{
    /** @test */
    public function it_passes(): void
    {
        EnumAssertions::assertSameEnumLabel(MyEnum::A(), MyEnum::A()->label);
    }

    /** @test */
    public function it_fails(): void
    {
        $this->expectException(ExpectationFailedException::class);

        EnumAssertions::assertSameEnumLabel(MyEnum::A(), MyEnum::A());
    }
}

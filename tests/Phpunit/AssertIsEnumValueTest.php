<?php

namespace Spatie\Enum\Tests\Phpunit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

class AssertIsEnumValueTest extends TestCase
{
    /** @test */
    public function it_passes(): void
    {
        EnumAssertions::assertIsEnumValue(MyEnum::class, 'A');
    }

    /** @test */
    public function it_fails(): void
    {
        $this->expectException(ExpectationFailedException::class);

        EnumAssertions::assertIsEnumValue(MyEnum::class, 'a');
    }
}

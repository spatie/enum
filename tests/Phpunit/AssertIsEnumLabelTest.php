<?php

namespace Spatie\Enum\Tests\Phpunit;

use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\EnumWithLabels;

class AssertIsEnumLabelTest extends TestCase
{
    /** @test */
    public function it_passes(): void
    {
        EnumAssertions::assertIsEnumLabel(EnumWithLabels::class, 'a');
    }

    /** @test */
    public function it_fails(): void
    {
        $this->expectException(ExpectationFailedException::class);

        EnumAssertions::assertIsEnumLabel(EnumWithLabels::class, 'A');
    }
}

<?php

namespace Spatie\Enum\Tests\Pest;

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\EnumWithLabels;

it('passes', function () {
    EnumAssertions::assertIsEnumLabel(EnumWithLabels::class, 'a');
});

it('fails', function () {
    $this->expectException(ExpectationFailedException::class);

    EnumAssertions::assertIsEnumLabel(EnumWithLabels::class, 'A');
});


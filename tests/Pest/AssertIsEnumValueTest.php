<?php

namespace Spatie\Enum\Tests\Pest;

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

it('passes', function () {
    EnumAssertions::assertIsEnumValue(MyEnum::class, 'A');
});

it('fails', function () {
    $this->expectException(ExpectationFailedException::class);

    EnumAssertions::assertIsEnumValue(MyEnum::class, 'a');
});

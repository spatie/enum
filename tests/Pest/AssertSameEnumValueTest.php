<?php

namespace Spatie\Enum\Tests\Pest;

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

it('passes', function () {
    EnumAssertions::assertSameEnumValue(MyEnum::A(), MyEnum::A()->value);
});

it('fails', function () {
    $this->expectException(ExpectationFailedException::class);

    EnumAssertions::assertSameEnumValue(MyEnum::A(), MyEnum::A());
});

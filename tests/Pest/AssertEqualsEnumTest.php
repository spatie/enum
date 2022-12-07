<?php

namespace Spatie\Enum\Tests\Pest;

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

it('passes', function () {
    EnumAssertions::assertEqualsEnum(MyEnum::A(), MyEnum::A());
    EnumAssertions::assertEqualsEnum(MyEnum::A(), MyEnum::A()->value);
    EnumAssertions::assertEqualsEnum(MyEnum::A(), MyEnum::A()->label);
});

it('fails', function () {
    $this->expectException(ExpectationFailedException::class);

    EnumAssertions::assertEqualsEnum(MyEnum::A(), 0);
});

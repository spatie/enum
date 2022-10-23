<?php

namespace Spatie\Enum\Tests\Pest;

use PHPUnit\Framework\ExpectationFailedException;
use Spatie\Enum\Phpunit\EnumAssertions;
use Spatie\Enum\Tests\MyEnum;

it('passes', function () {
    EnumAssertions::assertSameEnum(MyEnum::A(), MyEnum::A());
});

it('fails', function () {
    $this->expectException(ExpectationFailedException::class);

    EnumAssertions::assertSameEnum(MyEnum::A(), MyEnum::A()->value);
});

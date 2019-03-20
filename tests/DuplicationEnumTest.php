<?php

declare(strict_types=1);

namespace Spatie\Enum\OldTests;

use Spatie\Enum\Exceptions\DuplicatedIndexException;
use Spatie\Enum\Exceptions\DuplicatedValueException;
use Spatie\Enum\Tests\Enums\DuplicatedIndexEnum;
use Spatie\Enum\Tests\Enums\DuplicatedValueEnum;
use PHPUnit\Framework\TestCase;

class DuplicationEnumTest extends TestCase
{
    /** @test */
    public function can_not_resolve_with_duplicated_values()
    {
        $this->expectException(DuplicatedValueException::class);
        $this->expectExceptionMessage('The values ["foobar", "hello world"] are duplicated in enum Spatie\Enum\Tests\Enums\DuplicatedValueEnum');

        DuplicatedValueEnum::toArray();
    }

    /** @test */
    public function can_not_resolve_with_duplicated_indices()
    {
        $this->expectException(DuplicatedIndexException::class);
        $this->expectExceptionMessage('The indices [1000, 2000] are duplicated in enum Spatie\Enum\Tests\Enums\DuplicatedIndexEnum');

        DuplicatedIndexEnum::toArray();
    }
}

<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\DuplicatedIndexEnum;
use Spatie\Enum\Tests\Enums\DuplicatedValueEnum;
use Spatie\Enum\Exceptions\DuplicatedIndexException;
use Spatie\Enum\Exceptions\DuplicatedValueException;

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
    public function can_not_use_enum_if_value_is_duplicated()
    {
        $this->expectException(DuplicatedValueException::class);
        $this->expectExceptionMessage('The values ["foobar", "hello world"] are duplicated in enum Spatie\Enum\Tests\Enums\DuplicatedValueEnum');

        try {
            DuplicatedValueEnum::toArray();
        } catch(DuplicatedValueException $exception) {
            // ignore
        }

        DuplicatedValueEnum::toArray();
    }

    /** @test */
    public function can_not_resolve_with_duplicated_indices()
    {
        $this->expectException(DuplicatedIndexException::class);
        $this->expectExceptionMessage('The indices [1000, 2000] are duplicated in enum Spatie\Enum\Tests\Enums\DuplicatedIndexEnum');

        DuplicatedIndexEnum::toArray();
    }

    /** @test */
    public function can_not_use_enum_if_index_is_duplicated()
    {
        $this->expectException(DuplicatedIndexException::class);
        $this->expectExceptionMessage('The indices [1000, 2000] are duplicated in enum Spatie\Enum\Tests\Enums\DuplicatedIndexEnum');

        try {
            DuplicatedIndexEnum::toArray();
        } catch(DuplicatedIndexException $exception) {
            // ignore
        }

        DuplicatedIndexEnum::toArray();
    }
}

<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\BoolOverrideInternalEnum;

class BoolOverrideInternalEnumTest extends TestCase
{
    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'false' => 0,
            'true' => 1,
        ], BoolOverrideInternalEnum::toArray());
    }
}

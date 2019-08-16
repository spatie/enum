<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\BoolOverrideEnum;

class BoolOverrideEnumTest extends TestCase
{
    /** @test */
    public function can_override_internal_methods()
    {
        $this->assertEquals([
            'false' => 'FALSE',
            'true' => 'TRUE',
        ], BoolOverrideEnum::toArray());
    }
}

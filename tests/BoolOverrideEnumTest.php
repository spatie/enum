<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\BoolOverrideEnum;

class BoolOverrideEnumTest extends TestCase
{
    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'false' => 'FALSE',
            'true' => 'TRUE',
        ], BoolOverrideEnum::toArray());
    }
}

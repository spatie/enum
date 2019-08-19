<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\BoolOverrideResolveFromStaticMethodsEnum;

class BoolOverrideResolveFromStaticMethodsEnumTest extends TestCase
{
    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'false' => 0,
            'true' => 1,
        ], BoolOverrideResolveFromStaticMethodsEnum::toArray());
    }
}

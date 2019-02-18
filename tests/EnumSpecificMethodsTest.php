<?php

declare(strict_types=1);

namespace Spatie\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\TestClasses\MonthEnum;

class EnumSpecificMethodsTest extends TestCase
{
    /** @test */
    public function month_mapping()
    {
        $this->assertEquals(1, MonthEnum::january()->getNumericIndex());
        $this->assertEquals(12, MonthEnum::december()->getNumericIndex());
    }

    /** @test */
    public function static_enums_can_be_constructed_from_their_value()
    {
        $this->assertTrue(MonthEnum::june()->equals(MonthEnum::from('june')));
    }
}

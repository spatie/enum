<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\MonthEnum;

class MonthEnumTest extends TestCase
{
    /** @test */
    public function can_create_instance_from_static_method()
    {
        $january = MonthEnum::january();

        $this->assertInstanceOf(MonthEnum::class, $january);
        $this->assertSame(1, $january->getIndex());
        $this->assertSame('january', $january->getValue());
    }

    /** @test */
    public function can_make_instance_from_name()
    {
        $february = MonthEnum::make('february');

        $this->assertInstanceOf(MonthEnum::class, $february);
        $this->assertSame(2, $february->getIndex());
        $this->assertSame('february', $february->getValue());
    }

    /** @test */
    public function can_make_instance_from_index()
    {
        $march = MonthEnum::make(3);

        $this->assertInstanceOf(MonthEnum::class, $march);
        $this->assertSame(3, $march->getIndex());
        $this->assertSame('march', $march->getValue());
    }

    /** @test */
    public function can_check_if_instances_are_equal()
    {
        $this->assertTrue(MonthEnum::make(4)->isEqual(4));
        $this->assertFalse(MonthEnum::make(4)->isEqual(5));

        $this->assertTrue(MonthEnum::make(4)->isEqual('april'));
        $this->assertFalse(MonthEnum::make(4)->isEqual('may'));

        $this->assertTrue(MonthEnum::make(4)->isEqual(MonthEnum::april()));
        $this->assertFalse(MonthEnum::make(4)->isEqual(MonthEnum::may()));

        $this->assertTrue(MonthEnum::make(4)->isEqual(MonthEnum::make('april')));
        $this->assertFalse(MonthEnum::make(4)->isEqual(MonthEnum::make('may')));
    }

    /** @test */
    public function can_check_if_instance_is_any()
    {
        $this->assertTrue(MonthEnum::make(4)->isAny([4, 5]));
        $this->assertFalse(MonthEnum::make(4)->isAny([5, 6]));

        $this->assertTrue(MonthEnum::make(4)->isAny(['april', 'may']));
        $this->assertFalse(MonthEnum::make(4)->isAny(['may', 'june']));

        $this->assertTrue(MonthEnum::make(4)->isAny([MonthEnum::april(), MonthEnum::may()]));
        $this->assertFalse(MonthEnum::make(4)->isAny([MonthEnum::may(), MonthEnum::june()]));

        $this->assertTrue(MonthEnum::make(4)->isAny([MonthEnum::make('april'), MonthEnum::make('may')]));
        $this->assertFalse(MonthEnum::make(4)->isAny([MonthEnum::make('may'), MonthEnum::make('june')]));
    }

    /** @test */
    public function can_check_if_instance_is_any_with_mixed_array_values()
    {
        $this->assertTrue(MonthEnum::make(4)->isAny([4, 'april', MonthEnum::april()]));
        $this->assertFalse(MonthEnum::make(4)->isAny([5, 'may', MonthEnum::may()]));
    }
}

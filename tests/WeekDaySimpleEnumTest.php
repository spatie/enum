<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\WeekDaySimpleEnum;

class WeekDaySimpleEnumTest extends TestCase
{
    /** @test */
    public function can_create_instance_from_static_method()
    {
        $monday = WeekDaySimpleEnum::monday();

        $this->assertInstanceOf(WeekDaySimpleEnum::class, $monday);
        $this->assertSame(1, $monday->getIndex());
        $this->assertSame('Montag', $monday->getValue());
    }

    /** @test */
    public function can_make_instance_from_value()
    {
        $tuesday = WeekDaySimpleEnum::make('Dienstag');

        $this->assertInstanceOf(WeekDaySimpleEnum::class, $tuesday);
        $this->assertSame(2, $tuesday->getIndex());
        $this->assertSame('Dienstag', $tuesday->getValue());
    }

    /** @test */
    public function can_make_instance_from_name()
    {
        $wednesday = WeekDaySimpleEnum::make('wednesday');

        $this->assertInstanceOf(WeekDaySimpleEnum::class, $wednesday);
        $this->assertSame(3, $wednesday->getIndex());
        $this->assertSame('Mittwoch', $wednesday->getValue());
    }

    /** @test */
    public function can_make_instance_from_index()
    {
        $thursday = WeekDaySimpleEnum::make(4);

        $this->assertInstanceOf(WeekDaySimpleEnum::class, $thursday);
        $this->assertSame(4, $thursday->getIndex());
        $this->assertSame('Donnerstag', $thursday->getValue());
    }

    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'Montag' => 1,
            'Dienstag' => 2,
            'Mittwoch' => 3,
            'Donnerstag' => 4,
            'Freitag' => 5,
            'Samstag' => 6,
            'Sonntag' => 7,
        ], WeekDaySimpleEnum::toArray());
    }

    /** @test */
    public function can_represent_its_names_as_array()
    {
        $this->assertEquals([
            'MONDAY',
            'TUESDAY',
            'WEDNESDAY',
            'THURSDAY',
            'FRIDAY',
            'SATURDAY',
            'SUNDAY',
        ], WeekDaySimpleEnum::getNames());
    }

    /** @test */
    public function can_represent_its_values_as_array()
    {
        $this->assertEquals([
            'Montag',
            'Dienstag',
            'Mittwoch',
            'Donnerstag',
            'Freitag',
            'Samstag',
            'Sonntag',
        ], WeekDaySimpleEnum::getValues());
    }

    /** @test */
    public function can_represent_its_indices_as_array()
    {
        $this->assertEquals([
            1,
            2,
            3,
            4,
            5,
            6,
            7,
        ], WeekDaySimpleEnum::getIndices());
    }
}

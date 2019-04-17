<?php

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\WeekDayConflictingEnum;

class WeekDayConflictingEnumTest extends TestCase
{
    /** @test */
    public function can_create_instance_from_static_method()
    {
        $monday = WeekDayConflictingEnum::monday();

        $this->assertInstanceOf(WeekDayConflictingEnum::class, $monday);
        $this->assertSame(10, $monday->getIndex());
        $this->assertSame('lundi', $monday->getValue());
        $this->assertSame('MONDAY', $monday->getName());
    }

    /** @test */
    public function can_make_instance_from_value()
    {
        $tuesday = WeekDayConflictingEnum::make('mardi');

        $this->assertInstanceOf(WeekDayConflictingEnum::class, $tuesday);
        $this->assertSame(20, $tuesday->getIndex());
        $this->assertSame('mardi', $tuesday->getValue());
        $this->assertSame('TUESDAY', $tuesday->getName());
    }

    /** @test */
    public function can_make_instance_from_name()
    {
        $wednesday = WeekDayConflictingEnum::make('wednesday');

        $this->assertInstanceOf(WeekDayConflictingEnum::class, $wednesday);
        $this->assertSame(30, $wednesday->getIndex());
        $this->assertSame('mercredi', $wednesday->getValue());
        $this->assertSame('WEDNESDAY', $wednesday->getName());
    }

    /** @test */
    public function can_make_instance_from_index()
    {
        $thursday = WeekDayConflictingEnum::make(4);

        $this->assertInstanceOf(WeekDayConflictingEnum::class, $thursday);
        $this->assertSame(4, $thursday->getIndex());
        $this->assertSame('Donnerstag', $thursday->getValue());
        $this->assertSame('THURSDAY', $thursday->getName());
    }

    /** @test */
    public function can_represent_itself_as_array()
    {
        $this->assertEquals([
            'Donnerstag' => 4,
            'lundi' => 10,
            'mardi' => 20,
            'mercredi' => 30,
            'vendredi' => 50,
            'samedi' => 60,
            'dimanche' => 70,
        ], WeekDayConflictingEnum::toArray());
    }

    /** @test */
    public function can_represent_its_values_as_array()
    {
        $this->assertEquals([
            'Donnerstag',
            'lundi',
            'mardi',
            'mercredi',
            'vendredi',
            'samedi',
            'dimanche',
        ], WeekDayConflictingEnum::getValues());
    }

    /** @test */
    public function can_represent_its_names_as_array()
    {
        $this->assertEquals([
            'THURSDAY',
            'MONDAY',
            'TUESDAY',
            'WEDNESDAY',
            'FRIDAY',
            'SATURDAY',
            'SUNDAY',
        ], WeekDayConflictingEnum::getNames());
    }

    /** @test */
    public function can_represent_its_indices_as_array()
    {
        $this->assertEquals([
            4,
            10,
            20,
            30,
            50,
            60,
            70,
        ], WeekDayConflictingEnum::getIndices());
    }
}

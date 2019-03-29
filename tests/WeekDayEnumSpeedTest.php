<?php

declare(strict_types=1);

namespace Spatie\Enum\OldTests;

use PHPUnit\Framework\TestCase;
use Spatie\Enum\Tests\Enums\WeekDayEnum;
use Symfony\Component\Stopwatch\Stopwatch;

class WeekDayEnumSpeedTest extends TestCase
{
    /** @test */
    public function can_load_faster_from_cache_than_resolve()
    {
        $stopwatch = new Stopwatch(true);

        $stopwatch->start('uncached');
        WeekDayEnum::toArray();
        $uncached = $stopwatch->stop('uncached');

        $stopwatch->start('cached');
        WeekDayEnum::toArray();
        $cached = $stopwatch->stop('cached');

        $this->assertLessThan($uncached->getDuration(), $cached->getDuration());
        $this->assertLessThan(1, $cached->getDuration());
    }

    /** @test */
    public function can_load_stable_from_cache()
    {
        WeekDayEnum::toArray();

        $stopwatch = new Stopwatch(true);
        $stopwatch->start('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $stopwatch->lap('cached');
        WeekDayEnum::toArray();
        $cached = $stopwatch->stop('cached');

        $totalDuration = $cached->getDuration();
        $average = $totalDuration / count($cached->getPeriods());
        $min = $average / 2;
        $max = $average * 2;

        foreach($cached->getPeriods() as $period) {
            $this->assertGreaterThan($min, $period->getDuration());
            $this->assertLessThan($max, $period->getDuration());
        }
    }
}

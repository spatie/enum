<?php

namespace Spatie\Enum\Concerns;

trait Comparable
{
    /**
     * @param UnitEnum ...$others
     * @return bool
     */
    public function equals(UnitEnum ...$others): bool
    {
        foreach ($others as $other) {
            if ($this === $other) {
                return true;
            }
        }

        return false;
    }
}

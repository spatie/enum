<?php

namespace Spatie\Enum\Concerns;

use UnitEnum;

trait Comparable
{
    /**
     * @param \UnitEnum|\BackedEnum ...$others
     * @return bool
     */
    public function equals(UnitEnum|BackedEnum ...$others): bool
    {
        foreach ($others as $other) {
            if ($this === $other) {
                return true;
            }
        }

        return false;
    }
}

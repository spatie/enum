<?php

namespace Spatie\Enum\Concerns;

trait Comparable
{
    /**
     * @param enum ...$others
     * @return bool
     */
    public function equals(...$others): bool
    {
        foreach ($others as $other) {
            if ($this === $other) {
                return true;
            }
        }

        return false;
    }
}

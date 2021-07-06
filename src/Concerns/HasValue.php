<?php

namespace Spatie\Enum\Concerns;

trait HasValue
{
    public function value(): int|string
    {
        return $this->value;
    }

    /**
     * @return string[]|int[]
     */
    public static function values(): array
    {
        return array_map(
            static fn(self $enum): int|string => $enum->value(),
            static::cases()
        );
    }
}

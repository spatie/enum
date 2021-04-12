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
    public static function toValues(): array
    {
        return array_map(
            fn(self $enum) => $enum->value(),
            static::cases()
        );
    }
}

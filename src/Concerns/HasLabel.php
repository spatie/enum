<?php

namespace Spatie\Enum\Concerns;

trait HasLabel
{
    abstract public function label(): string;

    /**
     * @return string[]
     */
    public static function labels(): array
    {
        return array_map(
            static fn(self $enum): string => $enum->label(),
            static::cases()
        );
    }
}

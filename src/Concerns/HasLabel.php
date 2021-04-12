<?php

namespace Spatie\Enum\Concerns;

trait HasLabel
{
    abstract public function label(): string;

    /**
     * @return string[]
     */
    public static function toLabels(): array
    {
        return array_map(
            fn(self $enum) => $enum->label(),
            static::cases()
        );
    }
}

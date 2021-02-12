<?php

namespace Spatie\Enum;

/**
 * @template TEnumValue of string|int
 *
 * @internal
 * @psalm-internal Spatie\Enum
 * @psalm-immutable
 */
class EnumDefinition
{
    /** @var TEnumValue */
    public $value;

    public string $label;

    private string $methodName;

    /**
     * @param string $methodName
     * @param TEnumValue $value
     * @param string $label
     */
    public function __construct(string $methodName, $value, string $label)
    {
        $this->methodName = strtolower($methodName);
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * @param TEnumValue|string $input
     *
     * @return bool
     */
    public function equals($input): bool
    {
        if ($this->value === $input) {
            return true;
        }

        if (is_string($input) && $this->methodName === strtolower($input)) {
            return true;
        }

        return false;
    }
}

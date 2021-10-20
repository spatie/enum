<?php

namespace Spatie\Enum;

/**
 * @internal
 * @psalm-internal Spatie\Enum
 * @psalm-immutable
 */
class EnumDefinition
{
    /** @var string|int */
    public $value;

    public string $label;

    private string $methodName;

    /**
     * @param string $methodName
     * @param string|int $value
     * @param string $label
     */
    public function __construct(string $methodName, $value, string $label)
    {
        $this->methodName = strtolower($methodName);
        $this->value = $value;
        $this->label = $label;
    }

    /**
     * @param string|int $input
     *
     * @return bool
     */
    public function equals($input): bool
    {
        if ($this->value === $input) {
            return true;
        }

        if (is_string($input) && is_int($this->value) && $input === (string)$this->value) {
            return true;
        }

        if (is_string($input) && $this->methodName === strtolower($input)) {
            return true;
        }

        return false;
    }
}

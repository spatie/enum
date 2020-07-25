<?php

namespace Spatie\Enum;

/**  @internal */
final class EnumDefinition
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

    public function equals($input): bool
    {
        if ($this->value === $input) {
            return true;
        }

        if ($this->methodName === strtolower($input)) {
            return true;
        }

        return false;
    }
}

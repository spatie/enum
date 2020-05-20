<?php

namespace Spatie\Enum;

class EnumDefinition
{
    /** @var mixed */
    public $value;

    public string $label;

    private string $methodName;

    /**
     * @param string $methodName
     * @param mixed $value
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
        return $this->value === $input
            || $this->methodName === strtolower($input);
    }
}

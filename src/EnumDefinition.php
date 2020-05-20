<?php

namespace Spatie\Enum;

class EnumDefinition
{
    /** @var mixed */
    public $value;

    public string $label;

    private string $methodName;

    public function __construct(string $methodName, string $value, string $label)
    {
        $this->methodName = $methodName;
        $this->value = $value;
        $this->label = $label;
    }

    public function equals($input): bool
    {
        return $this->value === $input
            || $this->methodName === $input;
    }
}

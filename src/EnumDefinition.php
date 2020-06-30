<?php

namespace Spatie\Enum;

use ArrayAccess;
use BadMethodCallException;
use OutOfBoundsException;

/**
 * @internal
 */
final class EnumDefinition implements ArrayAccess
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

        if ($this->methodName === strtolower($input)) {
            return true;
        }

        return false;
    }

    public function offsetGet($offset)
    {
        if(in_array($offset, ['value', 'label'])) {
            return $this->{$offset};
        }

        throw new OutOfBoundsException();
    }

    public function offsetSet($offset, $value): void
    {
        throw new BadMethodCallException();
    }

    public function offsetExists($offset): bool
    {
        return in_array($offset, ['value', 'label']);
    }

    public function offsetUnset($offset)
    {
        throw new BadMethodCallException();
    }
}

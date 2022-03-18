<?php

namespace Takemo101\SimpleTempla\Shared;

use InvalidArgumentException;

/**
 * string value object class
 */
abstract class StringValueObject
{
    /**
     * constructor
     *
     * @param string $value
     * @throws InvalidArgumentException
     */
    final public function __construct(
        private string $value,
    ) {
        if (!$this->validate($this->value)) {
            throw new InvalidArgumentException('the string value is invalid');
        }
    }

    /**
     * get value
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * check the value in the constructor
     *
     * @param string $value
     * @return boolean
     */
    abstract protected function validate(string $value): bool;
}

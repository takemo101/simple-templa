<?php

namespace Takemo101\SimpleTempla\Template\Value;

use InvalidArgumentException;

/**
 * call function value class
 */
final class Call extends FactoryValue
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * constructor
     *
     * @param callable $callable
     * @param mixed $value
     * @throws InvalidArgumentException
     */
    public function __construct(
        callable $callable,
        private mixed $value = null,
    ) {
        if (!is_callable($callable)) {
            throw new InvalidArgumentException('constructor argument type error: not callable');
        }

        $this->callable = $callable;
    }

    /**
     * execute output process
     *
     * @return mixed
     */
    public function execute(): mixed
    {
        return call_user_func($this->callable, $this->value);
    }

    /**
     * factory method
     *
     * @param mixed $value
     * @return static
     */
    public function of(mixed $value): static
    {
        return new static($this->callable, $value);
    }
}

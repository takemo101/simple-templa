<?php

namespace Takemo101\SimpleTempla\Template\Value;

use InvalidArgumentException;

final class Call implements ValueInterface
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * constructor
     *
     * @param mixed $value
     * @param callable $callable
     * @throws InvalidArgumentException
     */
    public function __construct(
        private mixed $value,
        callable $callable,
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
}

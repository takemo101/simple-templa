<?php

namespace Takemo101\SimpleTempla\Template\Value;

/**
 * factory value super class
 */
abstract class FactoryValue implements ValueInterface
{
    /**
     * factory method
     *
     * @param mixed $value
     * @return static
     */
    abstract public function of(mixed $value): static;
}

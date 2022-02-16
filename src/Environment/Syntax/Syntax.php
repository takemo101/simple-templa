<?php

namespace Takemo101\SimpleTempla\Environment\Syntax;

use Takemo101\SimpleTempla\Shared\StringValueObject;
use InvalidArgumentException;

/**
 * syntax base class
 */
abstract class Syntax extends StringValueObject
{
    /**
     * is the syntax different?
     *
     * @param self $syntax
     * @return boolean
     */
    public function isDifferent(self $syntax): bool
    {
        return $this->value() != $syntax->value();
    }
}

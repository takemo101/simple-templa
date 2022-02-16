<?php

namespace Takemo101\SimpleTempla\Environment\Syntax;

/**
 * block syntax class
 */
final class BlockSyntax extends Syntax
{
    /**
     * validate regex
     *
     * @var string
     */
    const NotRegex = '/^[^a-zA-Z0-9\\\\s]+$/';

    /**
     * check the value in the constructor
     *
     * @param string $value
     * @return boolean
     */
    protected function validate(string $value): bool
    {
        return strlen($value) > 1 && preg_match(self::NotRegex, $value);
    }
}

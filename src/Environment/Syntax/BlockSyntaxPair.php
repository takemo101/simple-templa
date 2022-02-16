<?php

namespace Takemo101\SimpleTempla\Environment\Syntax;

use InvalidArgumentException;

/**
 * block syntax pair class
 */
final class BlockSyntaxPair
{
    /**
     * constructor
     *
     * @param BlockSyntax $prefix
     * @param BlockSyntax $suffix
     */
    public function __construct(
        private BlockSyntax $prefix,
        private BlockSyntax $suffix,
    ) {
        // the prefix and suffix syntax must be different
        if (!$this->prefix->isDifferent($this->suffix)) {
            throw new InvalidArgumentException('incorrect combination of prefix and suffix');
        }
    }

    /**
     * create syntax text by expression text
     *
     * @param string $expression
     * @return string
     */
    public function createSyntaxText(string $expression): string
    {
        return $this->prefix->value() . " {$expression} " . $this->suffix->value();
    }

    /**
     * get block syntax for prefix
     *
     * @return BlockSyntax
     */
    public function getBlockPrefix(): BlockSyntax
    {
        return $this->prefix;
    }

    /**
     * get block syntax for suffix
     *
     * @return BlockSyntax
     */
    public function getBlockSuffix(): BlockSyntax
    {
        return $this->suffix;
    }
}

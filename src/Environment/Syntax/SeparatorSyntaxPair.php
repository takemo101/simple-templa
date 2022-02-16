<?php

namespace Takemo101\SimpleTempla\Environment\Syntax;

use InvalidArgumentException;

/**
 * separator syntax pair class
 */
final class SeparatorSyntaxPair
{
    /**
     * constructor
     *
     * @param SeparatorSyntax $filterSeparator
     * @param SeparatorSyntax $valueSeparator
     */
    public function __construct(
        private SeparatorSyntax $filterSeparator,
        private SeparatorSyntax $valueSeparator,
    ) {
        // the separator syntax must be different
        if (!$this->filterSeparator->isDifferent($this->valueSeparator)) {
            throw new InvalidArgumentException('incorrect combination of separator');
        }
    }

    /**
     * get separator syntax for filter
     *
     * @return SeparatorSyntax
     */
    public function getFilterSeparator(): SeparatorSyntax
    {
        return $this->filterSeparator;
    }

    /**
     * get separator syntax for value
     *
     * @return SeparatorSyntax
     */
    public function getValueSeparator(): SeparatorSyntax
    {
        return $this->valueSeparator;
    }
}

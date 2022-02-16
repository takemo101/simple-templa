<?php

namespace Takemo101\SimpleTempla\Template;

use Takemo101\SimpleTempla\Filter\FilterName;


/**
 * replace block class
 */
final class ReplaceBlock
{
    /**
     * constructor
     *
     * @param ReplaceKey $replaceKey
     * @param ValueName[] $valueNames
     * @param FilterName[] $filterNames
     */
    public function __construct(
        private ReplaceKey $replaceKey,
        private array $valueNames,
        private array $filterNames,
    ) {
        //
    }

    /**
     * get replace key
     *
     * @return ReplaceKey
     */
    public function getReplaceKey(): ReplaceKey
    {
        return $this->replaceKey;
    }

    /**
     * get value names
     *
     * @return ValueName[]
     */
    public function getValueNames(): array
    {
        return $this->valueNames;
    }

    /**
     * get filter names
     *
     * @return FilterName[]
     */
    public function getFilterNames(): array
    {
        return $this->filterNames;
    }
}

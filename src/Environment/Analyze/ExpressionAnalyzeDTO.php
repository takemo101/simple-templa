<?php

namespace Takemo101\SimpleTempla\Environment\Analyze;

/**
 * expression analyze dto class
 */
final class ExpressionAnalyzeDTO
{
    /**
     * construct
     *
     * @param string[] $valueNames
     * @param string[] $filterNames
     */
    public function __construct(
        private array $valueNames,
        private array $filterNames = [],
    ) {
        //
    }

    /**
     * get value name array
     *
     * @return string[]
     */
    public function getValueNames(): array
    {
        return $this->valueNames;
    }

    /**
     * get filter name array
     *
     * @return string[]
     */
    public function getFilterNames(): array
    {
        return $this->filterNames;
    }
}

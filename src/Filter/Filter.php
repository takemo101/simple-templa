<?php

namespace Takemo101\SimpleTempla\Filter;

/**
 * filter class
 */
final class Filter
{
    /**
     * constructor
     *
     * @param FilterName $name
     * @param FilterProcessInterface $process
     */
    public function __construct(
        private FilterName $name,
        private FilterProcessInterface $process,
    ) {
        //
    }

    /**
     * filter process
     *
     * @param string $value
     * @return string
     */
    public function filtering(string $value): string
    {
        return $this->process->execute($value);
    }

    /**
     * get filter name
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}

<?php

namespace Takemo101\SimpleTempla\Filter;

/**
 * filter process interface
 */
interface FilterProcessInterface
{
    public function execute(string $value): string;
}

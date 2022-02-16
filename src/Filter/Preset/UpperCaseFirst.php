<?php

namespace Takemo101\SimpleTempla\Filter\Preset;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

/**
 * ucfirst wrapper filter class
 */
final class UpperCaseFirst implements FilterProcessInterface
{
    public function execute(string $value): string
    {
        return ucfirst($value);
    }
}

<?php

namespace Takemo101\SimpleTempla\Filter\Preset;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

/**
 * ucwords wrapper filter class
 */
final class UpperCaseWords implements FilterProcessInterface
{
    public function execute(string $value): string
    {
        return ucwords($value);
    }
}

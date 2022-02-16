<?php

namespace Takemo101\SimpleTempla\Filter\Preset;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

/**
 * strtoupper wrapper filter class
 */
final class StrToUpper implements FilterProcessInterface
{
    public function execute(string $value): string
    {
        return strtoupper($value);
    }
}

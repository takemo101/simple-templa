<?php

namespace Takemo101\SimpleTempla\Filter\Preset;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

/**
 * strtolower wrapper filter class
 */
final class StrToLower implements FilterProcessInterface
{
    public function execute(string $value): string
    {
        return strtolower($value);
    }
}

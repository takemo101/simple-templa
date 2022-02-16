<?php

namespace Takemo101\SimpleTempla\Filter\Preset;

use Takemo101\SimpleTempla\Filter\FilterProcessInterface;

/**
 * lcfirst wrapper filter class
 */
final class LowerCaseFirst implements FilterProcessInterface
{
    public function execute(string $value): string
    {
        return lcfirst($value);
    }
}

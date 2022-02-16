<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use Takemo101\SimpleTempla\Environment\DefaultEnvironmentCreator;
use Takemo101\SimpleTempla\Filter\Preset\{
    LowerCaseFirst,
    StrToLower,
    StrToUpper,
    UpperCaseFirst,
    UpperCaseWord,
};
use Takemo101\SimpleTempla\Filter\{
    FilterCollection,
    FilterName,
    Filter,
};

/**
 * filter test
 */
class FilterTest extends TestCase
{
}

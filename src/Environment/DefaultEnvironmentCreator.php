<?php

namespace Takemo101\SimpleTempla\Environment;

use Takemo101\SimpleTempla\Filter\{
    FilterCollection,
    Filter,
    FilterName,
};
use Takemo101\SimpleTempla\Filter\Preset\{
    StrToLower,
    StrToUpper,
    LowerCaseFirst,
    UpperCaseFirst,
    UpperCaseWords,
};

/**
 * environment default factory class
 */
final class DefaultEnvironmentCreator
{
    const BlockPrefix = '{{';
    const BlockSuffix = '}}';
    const FilterSeparator = '|';
    const ValueSeparator = '.';

    /**
     * factory method
     *
     * @return Environment
     */
    public static function create(): Environment
    {
        return new Environment(
            new SyntaxConfig(
                self::BlockPrefix,
                self::BlockSuffix,
                self::FilterSeparator,
                self::ValueSeparator,
            ),
            FilterCollection::fromArray([
                new Filter(
                    new FilterName('strtolower'),
                    new StrToLower,
                ),
                new Filter(
                    new FilterName('strtoupper'),
                    new StrToUpper,
                ),
                new Filter(
                    new FilterName('lcfirst'),
                    new LowerCaseFirst,
                ),
                new Filter(
                    new FilterName('ucfirst'),
                    new UpperCaseFirst,
                ),
                new Filter(
                    new FilterName('ucwords'),
                    new UpperCaseWords,
                ),
            ]),
        );
    }

    /**
     * factory method non filters
     *
     * @return Environment
     */
    public static function createSimple(): Environment
    {
        return new Environment(
            new SyntaxConfig(
                self::BlockPrefix,
                self::BlockSuffix,
                self::FilterSeparator,
                self::ValueSeparator,
            ),
            FilterCollection::fromArray([]),
        );
    }
}

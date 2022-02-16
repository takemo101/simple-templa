<?php

namespace Takemo101\SimpleTempla\Environment;

use Takemo101\SimpleTempla\Environment\Syntax\{
    BlockSyntax,
    BlockSyntaxPair,
    SeparatorSyntax,
    SeparatorSyntaxPair,
};
use InvalidArgumentException;

/**
 * syntax config class
 */
final class SyntaxConfig
{
    /**
     * @var BlockSyntaxPair
     */
    private BlockSyntaxPair $blockPair;

    /**
     * @var SeparatorSyntaxPair
     */
    private SeparatorSyntaxPair $separatorPair;

    /**
     * constructor
     *
     * @param string $blockPrefix
     * @param string $blockSuffix
     * @param string $filterSeparator
     * @param string $valueSeparator
     * @throws InvalidArgumentException
     */
    public function __construct(
        string $blockPrefix,
        string $blockSuffix,
        string $filterSeparator,
        string $valueSeparator,
    ) {
        $this->blockPair = new BlockSyntaxPair(
            new BlockSyntax($blockPrefix),
            new BlockSyntax($blockSuffix),
        );

        $this->separatorPair = new SeparatorSyntaxPair(
            new SeparatorSyntax($filterSeparator),
            new SeparatorSyntax($valueSeparator),
        );
    }

    /**
     * get block syntax pair
     *
     * @return BlockSyntaxPair
     */
    public function getBlockPair(): BlockSyntaxPair
    {
        return $this->blockPair;
    }

    /**
     * get separator syntax pair
     *
     * @return SeparatorSyntaxPair
     */
    public function getSeparatorPair(): SeparatorSyntaxPair
    {
        return $this->separatorPair;
    }
}

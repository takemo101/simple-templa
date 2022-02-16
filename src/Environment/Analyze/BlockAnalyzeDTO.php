<?php

namespace Takemo101\SimpleTempla\Environment\Analyze;

/**
 * block analyze text dto class
 */
final class BlockAnalyzeDTO
{
    /**
     * expression text in block syntax
     *
     * @var string
     */
    private string $expressionText;

    /**
     * construct
     *
     * @param string $blockText
     * @param string $expressionText
     */
    public function __construct(
        private string $blockText,
        string $expressionText,
    ) {
        $this->expressionText = trim($expressionText);
    }

    /**
     * get block text
     *
     * @return string
     */
    public function getBlockText(): string
    {
        return $this->blockText;
    }

    /**
     * get expression text
     *
     * @return string
     */
    public function getExpressionText(): string
    {
        return $this->expressionText;
    }

    /**
     * has expression text
     *
     * @return boolean
     */
    public function hasExpression(): bool
    {
        return !empty($this->expressionText);
    }
}

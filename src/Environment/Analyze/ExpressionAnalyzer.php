<?php

namespace Takemo101\SimpleTempla\Environment\Analyze;

use Takemo101\SimpleTempla\Environment\Syntax\SeparatorSyntaxPair;

/**
 * expression analyze class
 */
final class ExpressionAnalyzer
{
    public function __construct(
        private SeparatorSyntaxPair $pair,
    ) {
        //
    }

    /**
     * analyze expression text
     *
     * @param string $text
     * @return ExpressionAnalyzeDTO
     */
    public function analyze(string $text): ExpressionAnalyzeDTO
    {
        $filterSeparator = $this->pair->getFilterSeparator();
        $valueSeparator = $this->pair->getValueSeparator();

        if (strpos($text, $filterSeparator->value()) != false) {
            $filterTexts = $filterSeparator->separate($text);
            $valueText = array_shift($filterTexts);

            if ($valueText) {
                return new ExpressionAnalyzeDTO(
                    $valueSeparator->separate($valueText),
                    $filterTexts,
                );
            }
        }

        return new ExpressionAnalyzeDTO(
            $valueSeparator->separate($text),
        );
    }
}

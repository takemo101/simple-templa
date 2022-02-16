<?php

namespace Takemo101\SimpleTempla\Environment\Analyze;

use Takemo101\SimpleTempla\Template\{
    ValueName,
    AnalyzeText,
    ReplaceBlock,
    AnalyzedData,
    ReplaceBlockIterator,
};
use Takemo101\SimpleTempla\Environment\SyntaxConfig;
use Takemo101\SimpleTempla\Filter\FilterName;
use Takemo101\SimpleTempla\Exception\SyntaxAnalyzeException;
use InvalidArgumentException;

/**
 * syntax analyze class
 */
final class SyntaxAnalyzer
{
    /**
     * @var BlockAnalyzer
     */
    private BlockAnalyzer $blockAnalyzer;

    /**
     * @var ExpressionAnalyzer
     */
    private ExpressionAnalyzer $expressionAnalyzer;

    /**
     * constructor
     *
     * @param SyntaxConfig $config
     */
    public function __construct(
        private SyntaxConfig $config,
    ) {
        $this->blockAnalyzer = new BlockAnalyzer($this->config->getBlockPair());
        $this->expressionAnalyzer = new ExpressionAnalyzer($this->config->getSeparatorPair());
    }

    /**
     * analyze template text
     *
     * @param string $text
     * @return AnalyzedData
     */
    public function analyze(string $text): AnalyzedData
    {
        $blockAnlyzeDTOs = $this->blockAnalyzer->analyze($text);
        $analyzeText = new AnalyzeText($text);

        $replaceBlocks = [];

        if (count($blockAnlyzeDTOs)) {
            foreach ($blockAnlyzeDTOs as $blockAnlyzeDTO) {
                $replaceKey = $analyzeText->change($blockAnlyzeDTO->getBlockText());
                $expressionAnalyzeDTO = $this->expressionAnalyzer->analyze(
                    $blockAnlyzeDTO->getExpressionText()
                );

                try {
                    $replaceBlocks[] = new ReplaceBlock(
                        $replaceKey,
                        ValueName::fromArrayToObjects($expressionAnalyzeDTO->getValueNames()),
                        FilterName::fromArrayToObjects($expressionAnalyzeDTO->getFilterNames()),
                    );
                } catch (InvalidArgumentException $e) {
                    $expression = $this->config->getBlockPair()->createSyntaxText(
                        $blockAnlyzeDTO->getExpressionText(),
                    );
                    throw new SyntaxAnalyzeException("syntax analyze error! check this expression = {$expression}");
                }
            }
        }

        return new AnalyzedData(
            $analyzeText->toReplaceText(),
            ReplaceBlockIterator::fromArray(
                $replaceBlocks,
            ),
        );
    }
}

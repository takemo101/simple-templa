<?php

namespace Takemo101\SimpleTempla\Environment\Analyze;

use Takemo101\SimpleTempla\Environment\Syntax\BlockSyntaxPair;

/**
 * block text analyze class
 */
final class BlockAnalyzer
{
    public function __construct(
        private BlockSyntaxPair $pair,
    ) {
        //
    }

    /**
     * analyze block text
     *
     * @param string $text
     * @return BlockAnalyzeDTO[]
     */
    public function analyze(string $text): array
    {
        $result = [];

        $prefix = $this->pair->getBlockPrefix()->value();
        $suffix = $this->pair->getBlockSuffix()->value();

        if (preg_match_all("/{$prefix}(.+?){$suffix}/", $text, $matches)) {

            // get unique array
            $fullTexts = array_unique($matches[0]);
            $contents = array_unique($matches[1]);

            foreach ($fullTexts as $i => $fullText) {
                $content = $contents[$i];

                $blockParseDTO = new BlockAnalyzeDTO(
                    $fullText,
                    $content,
                );

                if ($blockParseDTO->hasExpression()) {
                    $result[] = $blockParseDTO;
                }
            }
        }

        return $result;
    }
}

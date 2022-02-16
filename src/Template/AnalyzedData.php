<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * analyzed data class
 */
final class AnalyzedData
{

    public function __construct(
        private ReplaceText $replaceText,
        private ReplaceBlockIterator $iterator,
    ) {
        //
    }

    /**
     * parse process
     *
     * @param TemplateValueCollection $values
     * @param FilterCollection $filters
     * @param
     * @return string
     */
    public function replace(
        ValueReplacer $replacer,
    ): string {
        $this->replaceText->reset();

        foreach ($this->iterator->iterator() as $replaceBlock) {
            // value replace
            $value = $replacer->replace($replaceBlock);

            // replace template text
            $this->replaceText->replace(
                $replaceBlock->getReplaceKey(),
                $value,
            );
        }

        return $this->replaceText->getReplacedText();
    }

    /**
     * get replace text
     *
     * @return ReplaceText
     */
    public function getReplaceText(): ReplaceText
    {
        return $this->replaceText;
    }

    /**
     * get replace block iterator
     *
     * @return ReplaceBlockIterator
     */
    public function getReplaceBlockIterator(): ReplaceBlockIterator
    {
        return $this->iterator;
    }
}

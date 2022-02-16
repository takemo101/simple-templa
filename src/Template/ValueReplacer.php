<?php

namespace Takemo101\SimpleTempla\Template;

use Takemo101\SimpleTempla\Filter\FilterCollection;

/**
 * value replacer
 */
final class ValueReplacer
{
    /**
     * constructor
     *
     * @param TemplateValueCollection $values
     * @param FilterCollection $filters
     * @param StringTransformerInterface $transformer
     */
    public function __construct(
        private TemplateValueCollection $values,
        private FilterCollection $filters,
        private StringTransformerInterface $transformer,
    ) {
        //
    }

    /**
     * value replace
     *
     * @param ReplaceBlock $replaceBlock
     * @return string
     */
    public function replace(ReplaceBlock $replaceBlock): string
    {
        // get the value from the collection
        $value = $this->transformer->transform(
            $this->values->findByValueNames(
                $replaceBlock->getValueNames(),
            ),
        );
        // filter the value
        $value = $this->filters->filtering(
            $value,
            $replaceBlock->getFilterNames(),
        );

        return $value;
    }
}

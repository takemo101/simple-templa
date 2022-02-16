<?php

namespace Takemo101\SimpleTempla\Template;

use Takemo101\SimpleTempla\Filter\{
    Filter,
    FilterCollection,
};

/**
 * template class
 */
final class Template
{
    /**
     * constructor
     *
     * @param AnalyzedData $analyzedData
     * @param FilterCollection $filters
     * @param StringTransformerInterface $transformer
     */
    public function __construct(
        private AnalyzedData $analyzedData,
        private FilterCollection $filters,
        private StringTransformerInterface $transformer,
    ) {
        //
    }

    /**
     * parse template text
     *
     * @param array $data
     * @return string
     */
    public function parse(array $data): string
    {
        $values = new TemplateValueCollection($data);

        return $this->analyzedData->replace(
            new ValueReplacer(
                $values,
                $this->filters,
                $this->transformer,
            )
        );
    }

    /**
     * add filter
     *
     * @param Filter $filter
     * @return self
     */
    public function addFilter(Filter $filter): self
    {
        $this->filters->add($filter);

        return $this;
    }

    /**
     * set string transformer
     *
     * @param StringTransformerInterface $transformer
     * @return self
     */
    public function setStringTransformer(StringTransformerInterface $transformer): self
    {
        $this->transformer = $transformer;

        return $this;
    }
}

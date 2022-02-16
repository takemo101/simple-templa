<?php

namespace Takemo101\SimpleTempla\Environment;

use Takemo101\SimpleTempla\Template\{
    Template,
    StringTransformerInterface,
    StringTransformer,
};
use Takemo101\SimpleTempla\Filter\{
    Filter,
    FilterCollection,
};
use Takemo101\SimpleTempla\Environment\Analyze\SyntaxAnalyzer;

/**
 * template environment class
 */
final class Environment
{
    /**
     * @var SyntaxAnalyzer
     */
    private SyntaxAnalyzer $analyzer;

    /**
     * constructor
     *
     * @param SyntaxConfig $config
     * @param FilterCollection $presetFilters
     * @param StringTransformerInterface|null $defaultTransformer
     */
    public function __construct(
        SyntaxConfig $config,
        private FilterCollection $presetFilters,
        private ?StringTransformerInterface $defaultTransformer = null,
    ) {
        $this->analyzer = new SyntaxAnalyzer($config);

        if (!$this->defaultTransformer) {
            $this->defaultTransformer = new StringTransformer;
        }
    }

    /**
     * create template object from text
     *
     * @param string $text
     * @return Template
     */
    public function createTemplate(string $text): Template
    {
        return new Template(
            $this->analyzer->analyze($text),
            $this->presetFilters->copy(),
            $this->defaultTransformer,
        );
    }

    /**
     * add preset filter
     *
     * @param Filter $filter
     * @return self
     */
    public function addPresetFilter(Filter $filter): self
    {
        $this->presetFilters->add($filter);

        return $this;
    }


    /**
     * set default string transformer
     *
     * @param StringTransformerInterface $transformer
     * @return self
     */
    public function setDefaultStringTransformer(StringTransformerInterface $transformer): self
    {
        $this->transformer = $transformer;

        return $this;
    }
}

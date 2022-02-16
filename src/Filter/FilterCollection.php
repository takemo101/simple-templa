<?php

namespace Takemo101\SimpleTempla\Filter;

/**
 * filter collection class
 */
final class FilterCollection
{
    /**
     * filter collection
     *
     * @var Filter[]
     */
    private array $filters;

    /**
     * private constructor
     *
     * @param Filter ...$filters
     */
    private function __construct(
        Filter ...$filters,
    ) {
        foreach ($filters as $filter) {
            $this->add($filter);
        }
    }

    /**
     * add filter
     *
     * @param Filter $filter
     * @return self
     */
    public function add(Filter $filter): self
    {
        $this->filters[$filter->name()] = $filter;

        return $this;
    }

    /**
     * execute filter process
     *
     * @param string $value
     * @param FilterName[] $names
     * @return string
     */
    public function filtering(string $value, array $names): string
    {
        // argument type check closure
        $check = function (FilterName ...$names) {
            return $names;
        };
        $check(...$names);

        foreach ($names as $name) {
            if ($filter = $this->findByFilterName($name)) {
                $value = $filter->filtering($value);
            }
        }

        return $value;
    }

    /**
     * find filter by filter name
     *
     * @param FilterName $name
     * @return Filter|null
     */
    private function findByFilterName(FilterName $name): ?Filter
    {
        return array_key_exists(
            $name->value(),
            $this->filters,
        ) ? $this->filters[$name->value()] : null;
    }

    /**
     * copy self object
     *
     * @return self
     */
    public function copy(): self
    {
        return static::fromArray(
            $this->filters
        );
    }

    /**
     * constructor from array
     *
     * @param Filter[] $filters
     * @return self
     */
    public static function fromArray(array $filters): self
    {
        return new self(...$filters);
    }
}

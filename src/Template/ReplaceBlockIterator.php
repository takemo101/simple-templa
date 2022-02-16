<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * replace block iterator class
 */
final class ReplaceBlockIterator
{
    /**
     * replace block iterator
     *
     * @var ReplaceBlock[]
     */
    private array $replaceBlocks;

    /**
     * private constructor
     *
     * @param ReplaceBlock ...$replaceBlocks
     */
    private function __construct(
        ReplaceBlock ...$replaceBlocks,
    ) {
        $this->replaceBlocks = $replaceBlocks;
    }

    /**
     * get iterator
     *
     * @return ReplaceBlock[]
     */
    public function iterator(): array
    {
        return $this->replaceBlocks;
    }

    /**
     * constructor from array
     *
     * @param ReplaceBlock[] $replaceBlocks
     * @return self
     */
    public static function fromArray(array $replaceBlocks): self
    {
        return new self(...$replaceBlocks);
    }
}

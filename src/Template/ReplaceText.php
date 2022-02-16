<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * replace text class
 */
final class ReplaceText
{
    /**
     * changed text
     *
     * @var string
     */
    private ?string $changedText;

    /**
     * replaced text
     *
     * @var string
     */
    private string $replacedText;

    /**
     * constructor
     *
     * @param ChangeKeyText $text changed text
     */
    public function __construct(
        AnalyzeText $text,
    ) {
        $this->replacedText = $text->getChangedText();
        $this->changedText = $text->getChangedText();
    }

    /**
     * get replaced text
     *
     * @return ?string
     */
    public function getReplacedText(): ?string
    {
        return $this->replacedText;
    }

    /**
     * replace reset
     *
     * @return void
     */
    public function reset(): void
    {
        $this->replacedText = $this->changedText;
    }

    /**
     * replace replace key to text
     *
     * @param BlockSyntaxText $blockText
     * @return self
     */
    public function replace(ReplaceKey $replaceKey, string $replace): self
    {
        $this->replacedText = str_replace(
            $replaceKey->value(),
            $replace,
            $this->replacedText,
        );

        return $this;
    }
}

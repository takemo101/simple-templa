<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * analyze text class
 */
final class AnalyzeText
{
    /**
     * changed text
     *
     * @var string
     */
    private string $changedText;

    /**
     * constructor
     *
     * @param string $text template base text
     */
    public function __construct(
        string $text,
    ) {
        $this->changedText = $text;
    }

    /**
     * get changed text
     *
     * @return string
     */
    public function getChangedText(): string
    {
        return $this->changedText;
    }

    /**
     * change block syntax to replace key
     *
     * @param string $blockText
     * @return ReplaceKey
     */
    public function change(string $blockText): ReplaceKey
    {
        $replaceKey = new ReplaceKey();

        $this->changedText = str_replace(
            $blockText,
            $replaceKey->value(),
            $this->changedText,
        );

        return $replaceKey;
    }

    /**
     * create analyze text object to replace text object
     *
     * @return ReplaceText
     */
    public function toReplaceText(): ReplaceText
    {
        return new ReplaceText($this);
    }
}

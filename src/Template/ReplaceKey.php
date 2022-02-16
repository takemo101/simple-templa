<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * replace key string class
 */
class ReplaceKey
{
    /**
     * replace key prefix
     *
     * @var string
     */
    const ReplacePrefix = "<<<";

    /**
     * replace key suffix
     *
     * @var string
     */
    const ReplaceSuffix = ">>>";

    /**
     * replace key
     *
     * @var string
     */
    private string $value;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->value = $this->createUniqueString();
    }

    /**
     * get value
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * to string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * create random string
     *
     * @return string
     */
    private function createUniqueString(): string
    {
        return self::ReplacePrefix . uniqid() . self::ReplaceSuffix;
    }
}

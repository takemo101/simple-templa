<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * transform mixed type to string type interface
 */
interface StringTransformerInterface
{
    /**
     * type transform
     *
     * @param mixed $value
     * @return string
     */
    public function transform(mixed $value): string;
}

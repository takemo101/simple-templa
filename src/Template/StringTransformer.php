<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * transform mixed type to string type class
 */
final class StringTransformer implements StringTransformerInterface
{
    /**
     * type transform
     *
     * @param mixed $value
     * @return string
     */
    public function transform(mixed $value): string
    {
        return (string) $value;
    }
}

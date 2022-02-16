<?php

namespace Takemo101\SimpleTempla\Environment\Syntax;

use Takemo101\SimpleTempla\Exception\SeparatorSyntaxException;

/**
 * separator syntax class
 */
final class SeparatorSyntax extends Syntax
{
    /**
     * validate regex
     *
     * @var string
     */
    const NotRegex = '/[^a-zA-Z0-9_\\\\s]+/';

    /**
     * check the value in the constructor
     *
     * @param string $value
     * @return boolean
     */
    protected function validate(string $value): bool
    {
        return strlen($value) == 1 && preg_match(self::NotRegex, $value);
    }

    /**
     * separate text
     *
     * @param string $text
     * @return string[]
     * @throws SeparatorSyntaxException
     */
    public function separate(string $text): array
    {
        $separator = $this->value();

        $result = array_unique(
            array_filter(
                explode($separator, $text)
            )
        );

        if (count($result) == 0) {
            throw new SeparatorSyntaxException('there is no separate string');
        }

        return $result;
    }
}

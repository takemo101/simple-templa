<?php

namespace Takemo101\SimpleTempla\Shared;

/**
 * alphabet name class
 */
abstract class AlphabetName extends StringValueObject
{
    /**
     * validate regex
     *
     * @var string
     */
    const Regex = '/^[a-zA-Z0-9_]+$/';

    /**
     * check the value in the constructor
     *
     * @param string $value
     * @return boolean
     */
    protected function validate(string $value): bool
    {
        return (bool)preg_match(self::Regex, $value);
    }

    /**
     * factory
     *
     * @param string[] $names
     * @return static[]
     */
    public static function fromArrayToObjects(array $names): array
    {
        $result = [];

        foreach ($names as $name) {
            $result[] = new static($name);
        }

        return $result;
    }
}

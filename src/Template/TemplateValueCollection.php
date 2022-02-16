<?php

namespace Takemo101\SimpleTempla\Template;

/**
 * first collection for template values class
 */
final class TemplateValueCollection
{
    /**
     * constructor
     *
     * @param mixed[] $values
     */
    public function __construct(
        private array $values
    ) {
        //
    }

    /**
     * find value by value names
     *
     * @param ValueName[] $names
     * @return mixed
     */
    public function findByValueNames(array $names): mixed
    {
        // argument type check closure
        $check = function (ValueName ...$names): array {
            return $names;
        };
        $check(...$names);

        $result = null;

        $value = $this->values;
        $nameLength = count($names) - 1;

        foreach ($names as $i => $name) {
            if (is_array($value) && array_key_exists($name->value(), $value)) {
                $value = $value[$name->value()];
            } else {
                break;
            }

            if ($nameLength == $i) {
                $result = $value;
            }
        }

        return $result;
    }
}

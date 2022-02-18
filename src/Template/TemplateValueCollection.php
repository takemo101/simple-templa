<?php

namespace Takemo101\SimpleTempla\Template;

use Takemo101\SimpleTempla\Template\Value\ValueInterface;

/**
 * first collection for template values class
 */
final class TemplateValueCollection
{
    /**
     * @var mixed[]
     */
    private array $cache = [];

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

        if ($result instanceof ValueInterface) {
            $result = $this->toCacheValue($result);
        }

        return $result;
    }

    /**
     * to cache value by object
     *
     * @param ValueInterface $value
     * @return mixed
     */
    private function toCacheValue(ValueInterface $value): mixed
    {
        $id = spl_object_id($value);

        if (!isset($this->cache[$id])) {
            $this->cache[$id] = $value->execute();
        }

        return $this->cache[$id];
    }
}

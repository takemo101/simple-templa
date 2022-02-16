<?php

namespace Takemo101\SimpleTempla\Template;

use Takemo101\SimpleTempla\Exception\StringTransformException;
use JsonSerializable;
use StdClass;

/**
 * transform mixed type to string type class
 */
final class StringTransformer implements StringTransformerInterface
{
    /**
     * transform methods
     *
     * @var string[]
     */
    protected array $methods = [
        'transformBoolean',
        'transformArray',
        'transformObject',
    ];

    /**
     * type transform
     *
     * @param mixed $value
     * @return string
     */
    public function transform(mixed $value): string
    {
        // execute transform method
        foreach ($this->methods as $method) {
            if ($v = $this->{$method}($value)) {
                $value = $v;
                break;
            }
        }

        return (string) $value;
    }

    /**
     * transform boolean type to string type
     *
     * @param mixed $value
     * @return string|null
     */
    protected function transformBoolean(mixed $value): ?string
    {
        // check boolean
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        return null;
    }

    /**
     * transform array type to string type
     *
     * @param array $value
     * @return string|null
     */
    protected function transformArray(mixed $value): ?string
    {
        // check array
        if (is_array($value)) {
            return $this->toJson($value);
        }

        return null;
    }

    /**
     * transform object type to string type
     *
     * @param mixed $value
     * @return string|null
     */
    protected function transformObject(mixed $value): ?string
    {
        // check object
        if (is_object($value)) {
            if ($value instanceof JsonSerializable || $value instanceof StdClass) {
                return $this->toJson($value);
            }

            if (!method_exists($value, '__toString')) {
                throw new StringTransformException('__toString method is missing');
            }
        }

        return null;
    }

    /**
     * to json string
     *
     * @param mixed $value
     * @return string
     */
    protected function toJson(mixed $value): string
    {
        return json_encode($value);
    }
}

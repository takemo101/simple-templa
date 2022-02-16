<?php

namespace Takemo101\SimpleTempla\Exception;

use Exception;

class StringTransformException extends Exception
{
    /**
     * constructor
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct("string transform error: {$message}");
    }
}

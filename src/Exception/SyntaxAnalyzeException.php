<?php

namespace Takemo101\SimpleTempla\Exception;

use Exception;

class SyntaxAnalyzeException extends Exception
{
    /**
     * constructor
     *
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct("syntax analyze error: check this expression {$message}");
    }
}

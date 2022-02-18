<?php

namespace Takemo101\SimpleTempla\Template\Value;

/**
 * value output interface
 */
interface ValueInterface
{
    /**
     * execute output process
     *
     * @return mixed
     */
    public function execute(): mixed;
}

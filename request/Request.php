<?php

namespace Request;


abstract class Request
{
    function __construct() {
        $this->set_parameter();
    }

    /**
     * @return bool
     */
    abstract public function validate(): bool;

    /**
     * @return array
     */
    abstract public function values(): array;

    /**
     * @return mixed
     */
    abstract public function set_parameter();
}
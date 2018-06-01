<?php

namespace Request;


abstract class Request
{
    function __construct() {
        $this->set_parameter();
    }

    abstract public function validate(): bool;

    abstract public function values(): array;

    abstract public function set_parameter();
}
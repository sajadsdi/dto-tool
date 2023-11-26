<?php

namespace Sajad\DtoTool\Exceptions;


class MethodNotFoundException extends \Exception
{
    public function __construct(public string $method, public string $class)
    {
        parent::__construct("Method '{$this->method}' is not found in '{$this->class}' DTO class!");
    }
}

<?php

namespace Sajadsdi\DtoTool\Exceptions;


class PropertyNotFoundException extends \Exception
{
    public function __construct(public string $property, public string $class)
    {
        parent::__construct("Public property '{$this->property}' is not defined in '{$this->class}' DTO class!");
    }
}

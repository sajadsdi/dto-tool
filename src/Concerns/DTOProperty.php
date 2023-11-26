<?php

namespace Sajadsdi\DtoTool\Concerns;

use Sajadsdi\PhpReflection\Concerns\Reflection;

trait DTOProperty
{
    use Reflection;

    private array $properties = [];

    /**
     * @return array
     * @throws \ReflectionException
     */
    private function properties(): array
    {
        if (!$this->properties) {
            $this->properties = array_map(function ($property) {
                return $property->getName();
            }, $this->getProperties($this, \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED));
        }
        return $this->properties;
    }

}

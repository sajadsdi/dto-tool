<?php

namespace Sajadsdi\DtoTool\Concerns;

use Sajadsdi\PhpReflection\Concerns\Reflection;

trait DTOProperty
{
    use Reflection;

    protected array $properties = [];

    /**
     * @param int $filter
     * @return array
     * @throws \ReflectionException
     */
    public function getProperties(int $filter = \ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PRIVATE): array
    {
        if (!$this->properties) {
            $this->properties = array_map(function ($property) {
                return $property->getName();
            }, $this->properties($this, $filter));
        }
        return $this->properties;
    }

}

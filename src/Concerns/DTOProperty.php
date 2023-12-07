<?php

namespace Sajadsdi\DtoTool\Concerns;

use ReflectionException;
use ReflectionProperty;
use Sajadsdi\PhpReflection\Concerns\Reflection;

/**
 * The DTOProperty trait provides methods to retrieve properties of a DTO class.
 *
 * @category Traits
 * @package  Sajadsdi\DtoTool\Concerns
 */
trait DTOProperty
{
    use Reflection;

    /**
     * The array of properties.
     *
     * @var array
     */
    protected array $properties = [];

    /**
     * The visibility of properties to be retrieved.
     *
     * @var int
     */
    protected int $Visibility = ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PRIVATE;

    /**
     * Retrieves the properties of the DTO class.
     *
     * @return array The properties of the DTO class.
     * @throws ReflectionException
     */
    public function getProperties(): array
    {
        if (!$this->properties) {
            $this->properties = array_map(
                function ($property) {
                    return $property->getName();
                },
                $this->properties($this, $this->Visibility)
            );
        }

        return $this->properties;
    }
}

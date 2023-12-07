<?php

namespace Sajadsdi\DtoTool\Concerns;

use ReflectionException;

/**
 * The DTOArray trait provides methods to retrieve array of a DTO class and init DTO Class.
 *
 * @category Traits
 * @package  Sajadsdi\DtoTool\Concerns
 */
trait DTOArray
{
    use DTOProperty, GetterSetter;

    /**
     * Convert the DTO to an array.
     *
     * @return array The DTO properties as an array.
     * @throws ReflectionException
     */
    public function toArray(): array
    {
        $properties = [];

        foreach ($this->getProperties() as $property) {
            if (isset($this->{$property})) {
                $method = "get" . ucfirst($property);
                $properties[$property] = $this->{$method}();
            } else {
                $properties[$property] = null;
            }
        }

        return $properties;
    }

    /**
     * Initialize the DTO from an array.
     *
     * @param array $data The data to initialize the DTO with.
     * @return static The initialized DTO object.
     * @throws ReflectionException
     */
    public function init(array $data): static
    {
        foreach ($this->getProperties() as $property) {
            if (isset($data[$property])) {
                $method = "set" . ucfirst($property);
                $this->{$method}($data[$property]);
            }
        }

        return $this;
    }
}

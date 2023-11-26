<?php

namespace Sajadsdi\DtoTool\Concerns;

trait DTOArray
{
    use Reflection;

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $properties = [];

        foreach ($this->getProperties($this) as $property) {
            $key = $property->getName();
            $properties[$key] = $this->{$key};
        }

        return $properties;
    }

    /**
     * @param array $data
     * @return $this
     * @throws \ReflectionException
     */
    public function init(array $data): static
    {
        foreach ($this->getProperties($this) as $property) {
            $key = $property->getName();
            if(isset($data[$key])){
                $this->{$key} = $data[$key];
            }
        }

        return $this;
    }
}

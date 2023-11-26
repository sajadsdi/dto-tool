<?php

namespace Sajadsdi\DtoTool\Concerns;

use Sajadsdi\PhpReflection\Concerns\Reflection;

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

        foreach ($this->getPublicProperties($this) as $property) {
            $properties[$property] = $this->{$property};
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
        foreach ($this->getPublicProperties($this) as $property) {
            if(isset($data[$property])){
                $this->{$property} = $data[$property];
            }
        }

        return $this;
    }
}

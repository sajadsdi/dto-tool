<?php

namespace Sajadsdi\DtoTool\Concerns;

trait DTOArray
{
    use DTOProperty;

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $properties = [];

        foreach ($this->properties() as $property) {
            if(isset($this->{$property})) {
                $properties[$property] = $this->{$property};
            }else{
                $properties[$property] = null;
            }
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
        foreach ($this->properties() as $property) {
            if(isset($data[$property])){
                $this->{$property} = $data[$property];
            }
        }

        return $this;
    }
}

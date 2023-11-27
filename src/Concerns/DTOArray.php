<?php

namespace Sajadsdi\DtoTool\Concerns;

trait DTOArray
{
    use DTOProperty,GetterSetter;

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $properties = [];

        foreach ($this->properties() as $property) {
            if(isset($this->{$property})) {
                $method = "get".ucfirst($property);
                $properties[$property] = $this->{$method}();
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
                $method = "set".ucfirst($property);
                $this->{$method}($data[$property]);
            }
        }

        return $this;
    }
}

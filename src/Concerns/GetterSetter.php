<?php

namespace Sajadsdi\DtoTool\Concerns;

use Sajadsdi\DtoTool\Exceptions\MethodNotFoundException;
use Sajadsdi\DtoTool\Exceptions\PropertyNotFoundException;

trait GetterSetter
{
    use DTOProperty;

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws \ReflectionException
     * @throws PropertyNotFoundException
     * @throws MethodNotFoundException
     */
    public function __call(string $name, array $arguments): mixed
    {
        if ($this->startWith('get', $name)) {
            return $this->getter($name);
        }
        if ($this->startWith('set', $name)) {
            return $this->setter($name, ...$arguments);
        }

        throw new MethodNotFoundException($name, static::class);
    }

    /**
     * @param string $prefix
     * @param string $string
     * @return bool
     */
    private function startWith(string $prefix, string $string): bool
    {
        return strncmp($string, $prefix, strlen($prefix)) === 0;
    }


    /**
     * @param string $name
     * @return mixed
     * @throws \ReflectionException
     * @throws PropertyNotFoundException
     */
    private function getter(string $name): mixed
    {
        $pName = lcfirst(str_replace('get', '', $name));
        if (in_array($pName, $this->properties())) {
            if (isset($this->{$pName})) {
                return $this->{$pName};
            }
            return null;
        }

        throw new PropertyNotFoundException($pName, static::class);
    }

    /**
     * @param string $name
     * @param mixed $data
     * @return $this
     * @throws \ReflectionException
     * @throws PropertyNotFoundException
     */
    private function setter(string $name, mixed $data): static
    {
        $pName = lcfirst(str_replace('set', '', $name));
        if (in_array($pName, $this->properties())) {
            $this->{$pName} = $data;
            return $this;
        }

        throw new PropertyNotFoundException($pName, static::class);
    }


}

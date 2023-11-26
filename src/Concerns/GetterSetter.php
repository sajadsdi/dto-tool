<?php

namespace Sajad\DtoTool\Concerns;

use Sajad\DtoTool\Exceptions\MethodNotFoundException;
use Sajad\DtoTool\Exceptions\PropertyNotFoundException;

trait GetterSetter
{
    use Reflection;

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
    public function startWith(string $prefix, string $string): bool
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
        if (in_array($pName, $this->getPublicProperties())) {
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
        if (in_array($pName, $this->getPublicProperties())) {
            $this->{$pName} = $data;
            return $this;
        }

        throw new PropertyNotFoundException($pName, static::class);
    }

    /**
     * @param string $name
     * @param $value
     * @throws \ReflectionException
     * @throws PropertyNotFoundException
     */
    public function __set(string $name, $value): void
    {
        $this->setter($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \ReflectionException
     * @throws PropertyNotFoundException
     */
    public function __get(string $name)
    {
        return $this->getter($name);
    }

}

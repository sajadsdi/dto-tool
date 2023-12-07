<?php

namespace Sajadsdi\DtoTool\Concerns;

use ReflectionException;
use Sajadsdi\DtoTool\Exceptions\MethodNotFoundException;
use Sajadsdi\DtoTool\Exceptions\PropertyNotFoundException;
/**
 * The GetterSetter trait provides methods for dynamic getter and setter functionality for DTO class.
 *
 * @category Traits
 * @package  Sajadsdi\DtoTool\Concerns
 */
trait GetterSetter
{
    use DTOProperty;

    /**
     * Handles the dynamic method calls for get and set property in DTO class.
     *
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws ReflectionException
     * @throws PropertyNotFoundException
     * @throws MethodNotFoundException
     */
    public function __call(string $name, array $arguments = []): mixed
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
     * Checks if a string starts with a given prefix.
     *
     * @param string $prefix
     * @param string $string
     * @return bool
     */
    private function startWith(string $prefix, string $string): bool
    {
        return strncmp($string, $prefix, strlen($prefix)) === 0;
    }

    /**
     * Handles the dynamic getter functionality.
     *
     * @param string $name
     * @return mixed
     * @throws ReflectionException
     * @throws PropertyNotFoundException
     */
    private function getter(string $name): mixed
    {
        $pName = lcfirst(str_replace('get', '', $name));
        if (in_array($pName, $this->getProperties())) {
            if (isset($this->{$pName})) {
                return $this->{$pName};
            }
            return null;
        }
        throw new PropertyNotFoundException($pName, static::class);
    }

    /**
     * Handles the dynamic setter functionality.
     *
     * @param string $name
     * @param mixed $data
     * @return $this
     * @throws ReflectionException
     * @throws PropertyNotFoundException
     */
    private function setter(string $name, mixed $data): static
    {
        $pName = lcfirst(str_replace('set', '', $name));
        if (in_array($pName, $this->getProperties())) {
            $this->{$pName} = $data;
            return $this;
        }
        throw new PropertyNotFoundException($pName, static::class);
    }
}

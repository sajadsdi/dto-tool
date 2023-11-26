<?php

namespace Sajad\DtoTool\Concerns;

trait Reflection
{
    private array $reflections = [];
    private array $publicProperties = [];

    /**
     * @throws \ReflectionException
     */
    public function getReflection(object|string $class): \ReflectionClass
    {
        if (!isset($this->reflections[$class::class])) {
            $this->reflections[$class::class] = new \ReflectionClass($class);
        }
        return $this->reflections[$class::class];
    }

    /**
     * @param object|string $class
     * @param int|null $filter
     * @return array
     * @throws \ReflectionException
     */
    public function getProperties(object|string $class, int|null $filter = \ReflectionProperty::IS_PUBLIC): array
    {
        return $this->getReflection($class)->getProperties($filter);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    private function getPublicProperties(): array
    {
        if (!$this->publicProperties) {
            foreach ($this->getProperties($this) as $property) {
                $this->publicProperties[] = $property->getName();
            }
        }

        return $this->publicProperties;
    }

    /**
     * @param object|string $class
     * @param int|null $filter
     * @return array
     * @throws \ReflectionException
     */
    public function getMethods(object|string $class, int|null $filter = \ReflectionMethod::IS_PUBLIC): array
    {
        return $this->getReflection($class)->getMethods($filter);
    }

    /**
     * @param object|string $class
     * @param int|null $filter
     * @return array
     * @throws \ReflectionException
     */
    public function getConstants(object|string $class, int|null $filter = \ReflectionClassConstant::IS_PUBLIC): array
    {
        return $this->getReflection($class)->getConstants($filter);
    }
}

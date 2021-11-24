<?php

declare(strict_types=1);

namespace CNastasi\DDD\Serializer;

use Closure;

class SerializerConfig
{
    /** @psalm-var array<class-string, Closure> */
    private array $serializers = [];

    /**
     * @psalm-param class-string $className
     * @psalm-param Closure $serializer
     */
    public function serialize(string $className, Closure $serializer): void
    {
        $this->serializers[$className] = $serializer;
    }

    /**
     * @param object $object
     *
     * @return ?Closure
     */
    public function serializerFor(object $object): ?Closure
    {
        $lastSerializer = null;

        foreach ($this->serializers as $className => $serializer) {
            if ($object instanceof $className) {
                $lastSerializer = $serializer;
            }
        }

        return $lastSerializer;
    }
}

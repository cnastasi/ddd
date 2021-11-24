<?php

declare(strict_types=1);

namespace CNastasi\DDD\Serializer;

interface Serializer
{
    /**
     * @psalm-param mixed $object
     * @psalm-return mixed
     */
    public function serialize(mixed $object): mixed;
}

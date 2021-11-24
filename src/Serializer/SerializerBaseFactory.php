<?php

declare(strict_types=1);

namespace CNastasi\DDD\Serializer;

use CNastasi\DDD\Primitive\Integer;

final class SerializerBaseFactory
{
    public function __invoke(): SerializerImpl
    {
        $config = new SerializerConfig();

        $this->configure($config);

        return new SerializerImpl($config);
    }

    protected function configure(SerializerConfig $config): void
    {
        $config->serialize(Integer::class, fn (Integer $integer) => $integer->toInt());
    }

    public static function make(): Serializer
    {
        return (new self())();
    }
}

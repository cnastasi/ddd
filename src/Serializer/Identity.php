<?php

declare(strict_types=1);

namespace CNastasi\DDD\Serializer;

final class Identity
{
    public function __invoke(mixed $value): mixed
    {
        return $value;
    }
}

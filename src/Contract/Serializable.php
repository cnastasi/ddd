<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Contract;

interface Serializable
{
    /**
     * @return array<mixed>|int|string|null
     */
    public function serialize();
}
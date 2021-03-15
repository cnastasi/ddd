<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

/**
 * @template T
 */
interface Serializable
{
    /**
     * @psalm-return T
     * @return mixed
     */
    public function serialize();
}

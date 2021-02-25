<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

/**
 * @template T
 *
 * @psalm-immutable
 */
interface Identifier extends ValueObject, Stringable
{
    /**
     * @psalm-return T
     */
    public function value();
}

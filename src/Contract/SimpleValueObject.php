<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

/**
 * @template T
 */
interface SimpleValueObject extends ValueObject
{
    /**
     * @psalm-param T $value
     * @phpstan-param T $value
     * @param mixed $value
     */
    public function __construct($value);

    /**
     * @psalm-return T
     * @return mixed
     */
    public function value();
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

/**
 * @template K of Identifier
 */
interface Entity extends CompositeValueObject
{
    /**
     * @psalm-return K
     */
    public function getId(): Identifier;
}

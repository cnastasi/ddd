<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

/**
 * @template K of Identifier
 */
interface Entity extends CompositeValueObject
{
    /**
     * @return K
     */
    public function getId(): Identifier;
}

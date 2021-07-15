<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\Identifier;

/**
 * @template K of Identifier
 *
 * @implements Entity<K>
 */
abstract class AbstractEntity implements Entity
{
    /** @psalm-var K */
    private Identifier $id;

    /**
     * @psalm-param K $id
     */
    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    /**
     * @psalm-return K
     */
    public function getId(): Identifier
    {
        return $this->id;
    }
}

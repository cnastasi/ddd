<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\Identifier;

/**
 * @template K of Identifier
 *
 * @implements Entity<K>
 *
 * @psalm-immutable
 */
abstract class AbstractEntity implements Entity
{
    /** @var K */
    private Identifier $id;

    /**
     * @param K $id
     */
    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    /**
     * @return K
     */
    public function getId(): Identifier
    {
        return $this->id;
    }
}

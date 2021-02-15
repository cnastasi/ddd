<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\Identifier;

abstract class AbstractEntity implements Entity
{
    private Identifier $id;

    public function __construct(Identifier $id)
    {
        $this->id = $id;
    }

    public function getId(): Identifier
    {
        return $this->id;
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\ValueObject\Primitive\Integer;

class IntegerIdentifier extends Integer implements Identifier
{
    protected int $min = 1;

    public function equalsTo(self $id): bool
    {
        return $id instanceof static
            && $id->value() === $this->value();
    }

    final public function __toString(): string
    {
        return (string) $this->value();
    }
}

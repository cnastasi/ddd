<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject;

use Cnastasi\DDD\ValueObject\Primitive\Integer;

abstract class IntegerId extends Integer
{
    protected int $min = 1;

    public function equalsTo(IntegerId $id): bool
    {
        return $id instanceof static
            && $id->value() === $this->value();
    }
}

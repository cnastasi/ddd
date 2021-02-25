<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\Error\DomainError;
use CNastasi\DDD\Error\InvalidIdentifier;
use CNastasi\DDD\ValueObject\Primitive\Integer;

/**
 * @implements Identifier<int>
 *
 * @psalm-immutable
 */
class IntegerIdentifier extends Integer implements Identifier
{
    protected int $min = 1;

    final public function __toString(): string
    {
        return (string) $this->value();
    }

    protected function validate($value): int
    {
        try {
            return parent::validate($value);
        } catch (DomainError $ex) {
            throw new InvalidIdentifier($value);
        }
    }
}

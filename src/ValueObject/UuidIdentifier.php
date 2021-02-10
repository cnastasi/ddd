<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\Error\InvalidUuid;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidIdentifier implements CompositeValueObject, Identifier
{
    private UuidInterface $value;

    final public function __construct(UuidInterface $value)
    {
        $this->value = $value;
    }

    final public function __toString(): string
    {
        return $this->value->toString();
    }

    /**
     * @param string $value
     *
     * @return static
     */
    final public static function fromString(string $value): self
    {
        if (!Uuid::isValid($value)) {
            throw new InvalidUuid($value);
        }

        return new static(Uuid::fromString($value));
    }

    final public function equalsTo(UuidIdentifier $id): bool
    {
        return $id instanceof static
            && $id->value->equals($this->value);
    }

    /**
     * @return static
     */
    final public static function new(): self
    {
        return new static(Uuid::uuid4());
    }

    public function toUuid(): UuidInterface
    {
        return $this->value;
    }
}

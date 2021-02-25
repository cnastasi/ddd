<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\Error\IncomparableObjects;
use CNastasi\DDD\Error\InvalidIdentifier;
use CNastasi\DDD\Error\InvalidUuid;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UuidIdentifier
 * @package CNastasi\DDD\ValueObject
 *
 * @psalm-immutable
 *
 * @implements Identifier<UuidInterface>
 */
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
            throw new InvalidIdentifier($value);
        }

        return new static(Uuid::fromString($value));
    }

    final public function equalsTo($id): bool
    {
        if ($id instanceof static){
            return $id->value->equals($this->value);
        }

        throw new IncomparableObjects($id, $this);
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

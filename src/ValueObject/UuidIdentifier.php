<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Comparable;
use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\Error\IncomparableObjects;
use CNastasi\DDD\Error\InvalidIdentifier;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
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

    /**
     * @param static $item
     *
     * @return bool
     */
    final public function equalsTo(Comparable $item): bool
    {
        if ($item instanceof static) {
            return $item->value->equals($this->value);
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @return static
     */
    final public static function new(): self
    {
        return new static(Uuid::uuid4());
    }

    public function value():UuidInterface
    {
        return $this->value;
    }
}

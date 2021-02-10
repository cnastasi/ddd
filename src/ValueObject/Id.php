<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject;

use Cnastasi\DDD\Contract\SimpleValueObject;
use Cnastasi\DDD\Error\InvalidIdFormat;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Id implements SimpleValueObject
{
    private UuidInterface $value;

    final public function __construct($value)
    {
        $this->assertIsUuid($value);

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
        if (! Uuid::isValid($value)) {
            throw new InvalidIdFormat($value);
        }

        return new static(Uuid::fromString($value));
    }

    final public function equalsTo(Id $id): bool
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

    public function value(): string
    {
        return $this->value->toString();
    }

    public function toUuid(): UuidInterface
    {
        return $this->value;
    }

    /**
     * @param UuidInterface|mixed $value
     */
    private function assertIsUuid($value): void
    {
        if (! ($value instanceof UuidInterface)) {
            throw new InvalidIdFormat($value);
        }
    }
}

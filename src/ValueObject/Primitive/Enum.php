<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\Comparable;
use CNastasi\DDD\Contract\SimpleValueObject;
use CNastasi\DDD\Contract\Stringable;

/**
 * @psalm-suppress MissingImmutableAnnotation
 *
 * @extends \MyCLabs\Enum\Enum<string>
 * @implements SimpleValueObject<string>
 */
abstract class Enum extends \MyCLabs\Enum\Enum implements SimpleValueObject, Stringable
{
    public function value(): string
    {
        return $this->getValue();
    }

    public function equalsTo(Comparable $item): bool
    {
        return $this->equals($item);
    }

    /**
     * @psalm-suppress MissingImmutableAnnotation
     */
    public function __toString(): string
    {
        return $this->value();
    }
}

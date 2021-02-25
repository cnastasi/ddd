<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\SimpleValueObject;

/**
 * @psalm-suppress MissingImmutableAnnotation
 *
 * @extends \MyCLabs\Enum\Enum<string>
 */
abstract class Enum extends \MyCLabs\Enum\Enum implements SimpleValueObject
{
    public function value(): string
    {
        return $this->getValue();
    }
}
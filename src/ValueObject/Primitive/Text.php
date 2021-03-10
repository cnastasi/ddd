<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\SimpleValueObject;
use CNastasi\DDD\Contract\Stringable;
use CNastasi\DDD\Error\IncomparableObjects;
use CNastasi\DDD\Error\InvalidString;

/**
 * @psalm-immutable
 *
 * @implements SimpleValueObject<string>
 */
class Text implements SimpleValueObject, Stringable
{
    protected const NOT_EMPTY = '/.*/';

    private string $value;

    protected string $pattern = self::NOT_EMPTY;

    final public function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    protected function validate($value): string
    {
        $castedValue = (string) $value;
        if (! preg_match($this->pattern, $castedValue)) {
            throw new InvalidString($castedValue, $this->pattern);
        }
        return $castedValue;
    }

    public function equalsTo($item): bool
    {
        if ($item instanceof static) {
            return $item->value === $this->value;
        }

        throw new IncomparableObjects($item, $this);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

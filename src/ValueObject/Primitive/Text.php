<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\SimpleValueObject;
use CNastasi\DDD\Error\IncomparableObjects;
use CNastasi\DDD\Error\InvalidString;

/**
 * Class Text
 * @package CNastasi\DDD\ValueObject\Primitive
 *
 * @psalm-immutable
 *
 * @implements SimpleValueObject<string>
 */
class Text implements SimpleValueObject
{
    private string $value;

    protected string $pattern = '/.*/';

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
}

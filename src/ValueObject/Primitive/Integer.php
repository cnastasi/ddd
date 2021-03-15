<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\ComparableNumber;
use CNastasi\DDD\Contract\SimpleValueObject;
use CNastasi\DDD\Error\IntegerTooBig;
use CNastasi\DDD\Error\IntegerTooSmall;
use CNastasi\DDD\Error\InvalidInteger;
use CNastasi\DDD\ValueObject\ComparableNumberTrait;

/**
 * @implements SimpleValueObject<int>
 *
 * @psalm-immutable
 */
abstract class Integer implements SimpleValueObject, ComparableNumber
{
    use ComparableNumberTrait;

    private int $value;

    protected int $min = \PHP_INT_MIN;

    protected int $max = \PHP_INT_MAX;

    final public function __construct($value)
    {
        $this->value = $this->validate($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    /**
     * @param int|mixed $value
     *
     * @return int
     */
    protected function validate($value): int
    {
        $castedValue = (int) $value;

        if (((string) $castedValue) !== (string) $value) {
            throw new InvalidInteger((string)$value);
        }

        if ($castedValue < $this->min) {
            throw new IntegerTooSmall($this->min, $castedValue);
        }

        if ($castedValue > $this->max) {
            throw new IntegerTooBig($this->max, $castedValue);
        }

        return $castedValue;
    }

    public function toInt(): int
    {
        return $this->value;
    }
}

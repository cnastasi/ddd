<?php

declare(strict_types=1);

namespace CNastasi\DDD\Primitive;

use CNastasi\DDD\Error\IntegerTooBig;
use CNastasi\DDD\Error\IntegerTooSmall;
use CNastasi\DDD\Error\InvalidValueObject;
use Stringable;
use const PHP_INT_MAX;
use const PHP_INT_MIN;

class Integer implements Stringable
{
    private int $value;

    protected int $min = PHP_INT_MIN;

    protected int $max = PHP_INT_MAX;

    /**
     * @throws IntegerTooBig
     * @throws IntegerTooSmall
     */
    final private function __construct(int $value)
    {
        if ($value < $this->min) {
            throw new IntegerTooSmall($this->min, $value);
        }

        if ($value > $this->max) {
            throw new IntegerTooBig($this->max, $value);
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function toInt(): int
    {
        return $this->value;
    }

    final public static function create(int|string $value): InvalidValueObject|static
    {
        $castedValue = (int)$value;

        if (((string)$castedValue) !== (string)$value) {
            return new InvalidValueObject('invalid integer', "Invalid Integer provided: {$value}");
        }
        try {
            return new static($castedValue);
        } catch (IntegerTooSmall $exception) {
            return new InvalidValueObject('integer too small', $exception->getMessage());
        } catch (IntegerTooBig $exception) {
            return new InvalidValueObject('integer too big', $exception->getMessage());
        }
    }
}

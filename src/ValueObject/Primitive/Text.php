<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Contract\SimpleValueObject;
use Cnastasi\DDD\Error\InvalidString;

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

    protected function validate($value): string
    {
        $castedValue = (string) $value;
        if (! preg_match($this->pattern, $castedValue)) {
            throw new InvalidString($castedValue, $this->pattern);
        }
        return $castedValue;
    }
}

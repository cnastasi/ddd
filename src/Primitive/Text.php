<?php

declare(strict_types=1);

namespace CNastasi\DDD\Primitive;

use CNastasi\DDD\Error\InvalidString;
use CNastasi\DDD\Error\InvalidValueObject;
use JetBrains\PhpStorm\Pure;
use Stringable;
use function preg_match;

class Text implements Stringable
{
    private string $value;

    protected string $regex = '/(.+)/';

    final public function __construct(string $value)
    {
        $this->validate($value);

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function validate(string $value): void
    {
        if (preg_match($this->regex, $value) !== 1) {
            throw new InvalidString($this->regex, $value);
        }
    }
}

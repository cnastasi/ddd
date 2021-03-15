<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\Contract\Stringable;

class Filter implements Stringable
{
    private ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function isSet(): bool
    {
        return $this->value !== null && $this->value !== '';
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}

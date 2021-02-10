<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

class Filter
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
        return $this->value !== null;
    }
}

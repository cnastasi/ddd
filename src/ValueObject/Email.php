<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject;

use Cnastasi\Serializer\Contract\SimpleValueObject;

final class Email implements SimpleValueObject
{
    private string $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function value()
    {
        return $this->value;
    }
}

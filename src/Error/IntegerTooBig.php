<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Error;

class IntegerTooBig extends ValueError
{
    public function __construct(int $min, int $value)
    {
        parent::__construct("The value {$value} is too small. Minimum {$min}");
    }
}

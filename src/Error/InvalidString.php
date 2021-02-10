<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Error;

class InvalidString extends ValueError
{
    public function __construct(string $value, string $pattern)
    {
        parent::__construct("The value {$value} doesn't match pattern $pattern.");
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class InvalidInteger extends TypeError
{
    public function __construct(string $value)
    {
        parent::__construct("The value '{$value}' should be an integer");
    }
}

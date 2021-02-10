<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Error;

class InvalidDateTime extends ValueError
{
    public function __construct(string $datetime)
    {
        parent::__construct("Invalid datetime provided ({$datetime})");
    }
}

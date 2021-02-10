<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class InvalidDate extends ValueError
{
    public function __construct(string $date)
    {
        parent::__construct("Invalid date provided ({$date})");
    }
}

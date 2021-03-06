<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class InvalidTime extends ValueError
{
    public function __construct(string $date)
    {
        parent::__construct("Invalid time provided ({$date})");
    }
}

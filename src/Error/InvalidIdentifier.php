<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class InvalidIdentifier extends ValueError
{
    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct("Invalid identifier: {$value}");
    }
}

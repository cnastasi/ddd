<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Error;

class InvalidIdFormat extends ValueError
{
    public function __construct(string $id)
    {
        parent::__construct("The id provided is invalid '{$id}'");
    }
}

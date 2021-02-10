<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class InvalidUuid extends ValueError
{
    public function __construct(string $id)
    {
        parent::__construct("The id provided is invalid '{$id}'");
    }
}

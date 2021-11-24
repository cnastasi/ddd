<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

use JetBrains\PhpStorm\Pure;

class InvalidString extends ValueError
{
    #[Pure] public function __construct(string $regex, string $value)
    {
        parent::__construct("Invalid string: '{$value}' does not match with '{$regex}'");
    }
}

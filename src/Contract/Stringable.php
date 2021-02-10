<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

interface Stringable
{
    public function __toString(): string;
}
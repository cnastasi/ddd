<?php

declare(strict_types=1);

namespace CNastasi\DDD\Serializer;

use Closure;

final class ClosureSerializer
{
    private Closure $closure;

    public function __construct()
    {
        $this->closure = static fn (object $value): object => $value;
    }

    public function with(Closure $closure): void
    {
        $this->closure = $closure;
    }

    public function __invoke(object $value): mixed
    {
        return ($this->closure)($value);
    }
}

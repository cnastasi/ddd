<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

abstract class PaginableEntityCollection extends EntityCollection
{
    private ?int $total = null;

    public function getTotal(): int
    {
        return $this->total ?? $this->count();
    }

    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\Paginable;

/**
 * @template K of int|string
 * @template T of Entity
 *
 * @extends EntityCollection<K, T>
 */
abstract class PaginableEntityCollection extends EntityCollection implements Paginable
{
    protected ?int $total = null;

    public function getTotal(): int
    {
        return $this->total ?? $this->count();
    }

    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\Contract\Paginable;
use CNastasi\DDD\Contract\ValueObject;

/**
 * @template K
 * @template T of ValueObject
 *
 * @extends AbstractCollection<K, T>
 */
abstract class PaginableCollection extends AbstractCollection implements Paginable
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

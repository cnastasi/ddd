<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\Collection\Pagination;

interface Paginable
{
    /**
     * @return static
     */
    public function paginate(Pagination $pagination): self;

    public function getTotal(): int;
}

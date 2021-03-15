<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\Collection\Pagination;

interface Paginable
{
    public function getTotal(): int;
}

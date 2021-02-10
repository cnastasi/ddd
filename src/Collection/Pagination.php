<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

final class Pagination
{
    private int $limit;

    private int $page;

    public function __construct(int $limit = 10, int $page = 0)
    {
        $this->limit = $limit;
        $this->page = $page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getOffset(): int
    {
        return $this->page * $this->limit;
    }
}

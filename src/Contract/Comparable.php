<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\Error\IncomparableObjects;

interface Comparable
{
    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function equalsTo($item): bool;
}
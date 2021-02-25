<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\Error\IncomparableObjects;

interface ComparableNumber extends Comparable
{
    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function lessThan($item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function lessOrEqualsThan($item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function greaterThan($item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function greaterOrEqualsThan($item): bool;

    public function toInt(): int;
}

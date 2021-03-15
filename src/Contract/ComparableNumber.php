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
    public function lessThan(ComparableNumber $item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function lessOrEqualsThan(ComparableNumber $item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function greaterThan(ComparableNumber $item): bool;

    /**
     * @param static $item
     *
     * @return bool
     *
     * @throws IncomparableObjects
     */
    public function greaterOrEqualsThan(ComparableNumber $item): bool;

    public function toInt(): int;
}

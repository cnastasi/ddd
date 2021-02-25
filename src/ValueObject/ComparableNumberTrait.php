<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Error\IncomparableObjects;

/**
 * Trait ComparableNumberTrait
 * @package CNastasi\DDD\ValueObject
 *
 * @psalm-immutable
 */
trait ComparableNumberTrait
{
    abstract public function toInt(): int;

    /**
     * @param static $item
     *
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function lessThan($item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() < $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @param static $item
     *
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function lessOrEqualsThan($item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() <= $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @param static $item
     *
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function greaterThan($item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() > $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @param static $item
     *
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function greaterOrEqualsThan($item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() >= $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @param static $item
     *
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function equalsTo($item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() === $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }
}

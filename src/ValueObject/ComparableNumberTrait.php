<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Comparable;
use CNastasi\DDD\Contract\ComparableNumber;
use CNastasi\DDD\Error\IncomparableObjects;

/**
 * @psalm-immutable
 *
 * @implements ComparableNumber
 */
trait ComparableNumberTrait
{
    abstract public function toInt(): int;

    /**
     * @psalm-return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function lessThan(ComparableNumber $item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() < $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @psalm-return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function lessOrEqualsThan(ComparableNumber $item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() <= $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @psalm-return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function greaterThan(ComparableNumber $item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() > $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function greaterOrEqualsThan(ComparableNumber $item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() >= $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }

    /**
     * @psalm-return bool|never-return
     *
     * @throws IncomparableObjects
     */
    public function equalsTo(Comparable $item): bool
    {
        if ($item instanceof static) {
            return $this->toInt() === $item->toInt();
        }

        throw new IncomparableObjects($item, $this);
    }
}

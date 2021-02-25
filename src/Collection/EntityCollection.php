<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\ValueObject\AbstractEntity;

/**
 * @template K of int|string
 * @template T of AbstractEntity
 *
 * @extends AbstractCollection<K, T>
 */
abstract class EntityCollection extends AbstractCollection
{
}

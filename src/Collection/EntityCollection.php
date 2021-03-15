<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use CNastasi\DDD\Contract\Entity;

/**
 * @template K of int|string
 * @template T of Entity
 *
 * @extends AbstractCollection<K, T>
 */
abstract class EntityCollection extends AbstractCollection
{
}

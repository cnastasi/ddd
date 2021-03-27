<?php

declare(strict_types=1);

namespace CNastasi\DDD\Examples;

use CNastasi\DDD\Collection\AbstractCollection;

/**
 * @extends AbstractCollection<int, DummyEntity>
 */
class DummyCollection extends AbstractCollection
{
    public function getItemType(): string
    {
        return DummyEntity::class;
    }
}
<?php

declare(strict_types=1);

namespace CNastasi\DDD\Examples;

use CNastasi\DDD\Contract\Comparable;
use CNastasi\DDD\ValueObject\AbstractEntity;
use CNastasi\DDD\ValueObject\IntegerIdentifier;

/**
 * @extends AbstractEntity<IntegerIdentifier>
 */
class DummyEntity extends AbstractEntity
{
    public function __construct(IntegerIdentifier $id)
    {
        parent::__construct($id);
    }

    public function equalsTo(Comparable $item): bool
    {
        return $this->getId()->equalsTo($item->getId());
    }
}
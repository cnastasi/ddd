<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use IteratorAggregate;

/**
 * @template T of ValueObject
 * @extends IteratorAggregate<ValueObject>
 */
interface Collection extends IteratorAggregate, ValueObject
{
    /**
     * @phpstan-param T $item
     * @param ValueObject $item
     */
    public function addItem(ValueObject $item): void;

    /**
     * @return class-string
     */
    public function getItemType(): string;
}

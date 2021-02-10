<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject;

use ArrayObject;
use Cnastasi\DDD\Contract\Collection;
use Cnastasi\DDD\Contract\ValueObject;
use Cnastasi\DDD\Error\UnsupportedCollectionItem;

/**
 * Class EntityCollection
 *
 * @template T of Entity
 * @implements Collection<T>
 */
abstract class EntityCollection implements Collection
{
    private array $collection = [];

    final public function __construct()
    {
    }

    /**
     * @phpstan-param T $item
     *
     * @param ValueObject $item
     */
    public function addItem(ValueObject $item): void
    {
        if (! $item instanceof Entity || ! $this->typeIsSupported($item)) {
            throw new UnsupportedCollectionItem(\get_class($item), $this->getItemType());
        }

        $this->collection[$item->getId()->value()] = $item;
    }

    /**
     * @phpstan-return ArrayObject<T>
     *
     * @return ArrayObject<Entity>
     */
    public function getIterator(): ArrayObject
    {
        return new ArrayObject($this->collection);
    }

    public function count(): int
    {
        return \count($this->collection);
    }

    public function has($item): bool
    {
        if ($this->typeIsSupported($item)) {
            $key = $item->getId()->value();

            return isset($this->collection[$key]);
        }

        return false;
    }

    /**
     * @phpstan-return T | null
     *
     * @return Entity|null
     */
    public function first(): ?Entity
    {
        return \reset($this->collection);
    }

    public function paginate(Pagination $pagination): self
    {
        $array = \array_slice(\array_values($this->collection), $pagination->getOffset(), $pagination->getLimit());

        return self::fromArray($array);
    }

    public static function fromArray(array $array): self
    {
        $collection = new static();

        foreach ($array as $item) {
            $collection->addItem($item);
        }

        return $collection;
    }

    private function typeIsSupported($entity): bool
    {
        return \is_a($entity, $this->getItemType(), true);
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use ArrayObject;
use CNastasi\DDD\Contract\Collection;
use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\ValueObject;
use CNastasi\DDD\Error\UnsupportedCollectionItem;
use CNastasi\DDD\ValueObject\AbstractEntity;

/**
 * Class EntityCollection
 *
 * @template T of AbstractEntity
 * @implements Collection<T>
 */
abstract class EntityCollection implements Collection
{
    /** @var array<string, T> */
    private array $collection = [];

    private ?int $total = null;

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
        if (!$item instanceof AbstractEntity || !$this->typeIsSupported($item)) {
            throw new UnsupportedCollectionItem(\get_class($item), $this->getItemType());
        }

        $this->collection[(string)$item->getId()] = $item;
    }

    /**
     * @phpstan-return ArrayObject<string, T>
     *
     * @return ArrayObject<string, AbstractEntity>
     */
    public function getIterator(): ArrayObject
    {
        return new ArrayObject($this->collection);
    }

    public function count(): int
    {
        return \count($this->collection);
    }

    /**
     * @param Entity $item
     *
     * @return bool
     */
    public function has($item): bool
    {
        if ($this->typeIsSupported($item)) {
            $key = (string)$item->getId();

            return isset($this->collection[$key]);
        }

        return false;
    }

    /**
     * @phpstan-return T | null
     *
     * @return AbstractEntity|null
     */
    public function first(): ?AbstractEntity
    {
        $first = \reset($this->collection);

        return $first === false ? null : $first;
    }

    /**
     * @param Pagination $pagination
     *
     * @return static<AbstractEntity>
     */
    public function paginate(Pagination $pagination): self
    {
        $array = \array_slice(\array_values($this->collection), $pagination->getOffset(), $pagination->getLimit());

        return static::fromArray($array);
    }

    /**
     * @param array<T> $array
     *
     * @return EntityCollection<T>
     */
    public static function fromArray(array $array): self
    {
        $collection = new static();

        foreach ($array as $item) {
            $collection->addItem($item);
        }

        return $collection;
    }

    /**
     * @param Entity $entity
     * @return bool
     */
    private function typeIsSupported($entity): bool
    {
        return \is_a($entity, $this->getItemType(), true);
    }

    public function getTotal(): int
    {
        return $this->total ?? $this->count();
    }

    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }

}

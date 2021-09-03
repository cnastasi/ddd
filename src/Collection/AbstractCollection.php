<?php

declare(strict_types=1);

namespace CNastasi\DDD\Collection;

use ArrayObject;
use Closure;
use CNastasi\DDD\Contract\Collection;
use CNastasi\DDD\Contract\Comparable;
use CNastasi\DDD\Contract\ValueObject;
use CNastasi\DDD\Error\UnsupportedCollectionItem;
use Traversable;

/**
 * @template K
 * @template T of ValueObject
 *
 * @implements Collection<K, T>
 */
abstract class AbstractCollection implements Collection, Comparable
{
    /**
     * @property ArrayObject<K, T>
     */
    protected ArrayObject $collection;

    final public function __construct()
    {
        $this->collection = new ArrayObject();
    }

    public function addItem(ValueObject $item): void
    {
        if (!$this->typeIsSupported($item)) {
            throw new UnsupportedCollectionItem(\get_class($item), $this->getItemType());
        }

        $this->collection->append($item);
    }

    /**
     * @param T $item
     *
     * @return bool
     */
    private function typeIsSupported($item): bool
    {
        return \is_a($item, $this->getItemType(), true);
    }

    abstract public function getItemType(): string;

    public function getIterator(): Traversable
    {
        return $this->collection->getIterator();
    }

    /**
     * @param Closure(T):bool $filterFunction
     *
     * @return static
     */
    public function filter(Closure $filterFunction): self
    {
        $collection = new static();

        foreach ($this as $item) {
            if ($filterFunction($item)) {
                $collection->addItem($item);
            }
        }

        return $collection;
    }

    public function walk(Closure $filterFunction): void
    {
        foreach ($this as $item) {
            $filterFunction($item);
        }
    }

    public function count(): int
    {
        return $this->collection->count();
    }

    /**
     * @param T $item
     *
     * @return bool
     */
    public function has(ValueObject $item): bool
    {
        /** @var T $element */
        foreach ($this->collection as $element) {
            if ($element->equalsTo($item)) {
                return true;
            }
        }

        return false;
    }

    public function hasKey($key): bool
    {
        return $this->collection->offsetExists($key);
    }

    /**
     * @param list<ValueObject> $array
     *
     * @return static
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
     * @return ?T
     */
    public function first(): ?ValueObject
    {
        $array = $this->collection->getArrayCopy();

        /** @var T|false $first */
        $first = \reset($array);

        return $first ?: null;
    }

    /**
     * @param K $key
     *
     * @return ?T
     */
    public function get($key): ?ValueObject
    {
        /** @var T|null $item */
        $item = $this->collection->offsetGet($key);

        return $item;
    }

    /**
     * @template R
     * @param callable(T): R $func
     * @return array<array-key, R>
     */
    public function map(callable $func): array
    {
        $result = [];

        /**
         * @psalm-var T $element
         * @psalm-var int $key
         */
        foreach ($this->collection as $key => $element) {
            $result[$key] = $func($element);
        }

        return $result;
    }

    /**
     * @return T[]
     */
    public function toArray(): array
    {
        /** @var T[] $arrayed */
        $arrayed = $this->collection->getArrayCopy();

        return $arrayed;
    }

    /**
     * @param static $collection
     * @return bool
     */
    public function equalsTo(Comparable $collection): bool
    {
        $count = $this->count();

        if ($collection->count() !== $count) {
            return false;
        }

        /** @var array<K, T> $array1 */
        $array1 = $this->toArray();

        /** @var array<K, T> $array2 */
        $array2 = $collection->toArray();

        foreach ($array1 as $key => $element) {
            if (!$array2[$key]->equalsTo($element)) {
                return false;
            }
        }

        return true;
    }
}

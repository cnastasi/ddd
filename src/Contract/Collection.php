<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use Closure;
use IteratorAggregate;

/**
 * @template K
 * @template T of ValueObject
 *
 * @extends IteratorAggregate<K, T>
 */
interface Collection extends IteratorAggregate
{
    /**
     * @psalm-param T $item
     */
    public function addItem(ValueObject $item): void;

    /**
     * @psalm-param T $item
     */
    public function has(ValueObject $item): bool;

    /**
     * @psalm-return ?T
     */
    public function first(): ?ValueObject;

    /**
     * @psalm-param K $key
     *
     * @psalm-return ?T
     */
    public function get($key): ?ValueObject;

    /**
     * @psalm-param K $key
     */
    public function hasKey($key): bool;

    public function count(): int;

    /**
     * @return class-string<ValueObject>
     */
    public function getItemType(): string;

    /**
     * @param Closure(T):bool $filterFunction
     *
     * @return Collection<K, T>
     */
    public function filter(Closure $filterFunction): self;

    /**
     * @param Closure(T):void $filterFunction
     */
    public function walk(Closure $filterFunction): void;

    /**
     * @param list<ValueObject> $array
     *
     * @return static
     */
    public static function fromArray(array $array): self;
}

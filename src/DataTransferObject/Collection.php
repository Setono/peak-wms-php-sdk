<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 *
 * @implements \IteratorAggregate<int, T>
 */
final class Collection implements \IteratorAggregate, \Countable
{
    /** @var list<T> */
    private array $items;

    /**
     * @param list<T> $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function empty(): bool
    {
        return [] === $this->items;
    }

    /**
     * @return \ArrayIterator<int<0, max>, T>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * @param callable(T):bool $callback
     *
     * @return self<T>
     */
    public function filter(callable $callback): self
    {
        return new self(array_values(array_filter($this->items, $callback)));
    }

    /**
     * @return list<T>
     */
    public function toArray(): array
    {
        return $this->items;
    }
}

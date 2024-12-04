<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 * @implements \IteratorAggregate<int, T>
 * @implements \ArrayAccess<int, T>
 */
class Collection implements \IteratorAggregate, \Countable, \ArrayAccess
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
     * @return \ArrayIterator<int<0,max>, T>
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
     * @param callable(T):numeric $callback
     */
    public function sum(callable $callback): int|float
    {
        return array_sum(array_map($callback, $this->items));
    }

    /**
     * @return list<T>
     */
    public function toArray(): array
    {
        return $this->items;
    }

    /**
     * @psalm-assert-if-true T $this->items[$offset]
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    /**
     * @return T
     */
    public function offsetGet(mixed $offset): object
    {
        if (!is_int($offset)) {
            throw new \InvalidArgumentException('The offset must be an integer');
        }

        if (!$this->offsetExists($offset)) {
            throw new \OutOfBoundsException(sprintf('The offset %s does not exist', $offset));
        }

        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \BadMethodCallException('You cannot set an item in a collection');
    }

    public function offsetUnset(mixed $offset): void
    {
        throw new \BadMethodCallException('You cannot unset an item in a collection');
    }
}

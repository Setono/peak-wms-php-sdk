<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 *
 * @extends Collection<T>
 */
final class PaginatedCollection extends Collection
{
    /**
     * @param list<T> $items
     */
    public function __construct(
        array $items = [],
        public readonly int $page = 0,
        public readonly int $pageSize = 0,
        public readonly int $totalRecords = 0,
    ) {
        parent::__construct($items);
    }
}

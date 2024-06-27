<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Request\Query\Product;

use Setono\PeakWMS\Request\Query\Query;

final class PageQuery extends Query
{
    /**
     * @param int $page The first page is 0, not 1
     * @param int $pageSize The maximum page size is 100
     */
    public static function create(int $page = 0, int $pageSize = 100, \DateTimeInterface $updatedAfter = null): self
    {
        return new self(array_filter([
            'Page' => $page,
            'PageSize' => $pageSize,
            'updatedAfter' => $updatedAfter,
        ], static fn ($value): bool => null !== $value));
    }

    /**
     * @throws \LogicException If the page parameter is not set or is not an integer
     */
    public function incrementPage(): void
    {
        if (!isset($this->parameters['Page']) || !is_int($this->parameters['Page'])) {
            throw new \LogicException('The page parameter must be set and be an integer');
        }

        ++$this->parameters['Page'];
    }
}

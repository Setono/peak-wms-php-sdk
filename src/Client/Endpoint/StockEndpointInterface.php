<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Stock\Stock;
use Setono\PeakWMS\Request\Query\KeySetPageQuery;

/**
 * @extends EndpointInterface<Stock>
 */
interface StockEndpointInterface extends EndpointInterface
{
    /**
     * @return PaginatedCollection<Stock>
     */
    public function getPage(KeySetPageQuery $query = null): PaginatedCollection;

    /**
     * @return iterable<Stock>
     */
    public function iterate(KeySetPageQuery $query = null): iterable;
}

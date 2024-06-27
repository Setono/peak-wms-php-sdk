<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Product\Product;
use Setono\PeakWMS\Request\Query\Product\PageQuery;

/**
 * @extends EndpointInterface<Product>
 * @extends CreatableEndpointInterface<Product>
 */
interface ProductEndpointInterface extends EndpointInterface, CreatableEndpointInterface, DeletableEndpointInterface
{
    /**
     * @return PaginatedCollection<Product>
     */
    public function getPage(PageQuery $query): PaginatedCollection;

    /**
     * @return Collection<Product>
     */
    public function getByProductId(string $productId): Collection;

    /**
     * @return iterable<Product>
     */
    public function iterate(PageQuery $query = null): iterable;
}

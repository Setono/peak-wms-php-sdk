<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Product\Product;
use Setono\PeakWMS\Request\Query\KeySetPageQuery;

/**
 * @extends EndpointInterface<Product>
 * @extends CreatableEndpointInterface<Product>
 * @extends UpdatableEndpointInterface<Product>
 */
interface ProductEndpointInterface extends EndpointInterface, CreatableEndpointInterface, DeletableEndpointInterface, UpdatableEndpointInterface
{
    /**
     * @return PaginatedCollection<Product>
     */
    public function getPage(KeySetPageQuery $query = null): PaginatedCollection;

    /**
     * @return Collection<Product>
     */
    public function getByProductId(string $productId): Collection;

    /**
     * @return iterable<Product>
     */
    public function iterate(KeySetPageQuery $query = null): iterable;
}

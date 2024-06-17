<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\Product\Product;

/**
 * @extends EndpointInterface<Product>
 * @extends CreatableEndpointInterface<Product>
 */
interface ProductEndpointInterface extends EndpointInterface, CreatableEndpointInterface, DeletableEndpointInterface
{
    /**
     * @return Collection<Product>
     */
    public function getByProductId(string $productId): Collection;
}

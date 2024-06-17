<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\Product\Product;

/**
 * @extends Endpoint<Product>
 */
final class ProductEndpoint extends Endpoint implements ProductEndpointInterface
{
    /**
     * @use CreatableEndpointTrait<Product>
     */
    use CreatableEndpointTrait;

    use DeletableEndpointTrait;

    public function getByProductId(string $productId): Collection
    {
        /** @var class-string<Collection<Product>> $signature */
        $signature = sprintf('%s<%s>', Collection::class, self::getDataClass());

        return $this
            ->mapperBuilder
            ->mapper()
            ->map(
                $signature,
                $this->createSource(
                    $this->client->get(sprintf('%s/%s', $this->endpoint, $productId)),
                ),
            );
    }

    protected static function getDataClass(): string
    {
        return Product::class;
    }
}

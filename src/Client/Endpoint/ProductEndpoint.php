<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Product\Product;
use Setono\PeakWMS\Request\Query\Product\PageQuery;

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

    /**
     * @return PaginatedCollection<Product>
     */
    public function getPage(PageQuery $query = null): PaginatedCollection
    {
        $query ??= PageQuery::create();

        /** @var class-string<PaginatedCollection<Product>> $signature */
        $signature = sprintf('%s<%s>', PaginatedCollection::class, self::getDataClass());

        return $this
            ->mapperBuilder
            ->mapper()
            ->map(
                $signature,
                $this->createSource(
                    $this->client->get($this->endpoint, $query),
                )->map(['data' => 'items']),
            );
    }

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

    /**
     * @return \Generator<Product>
     */
    public function iterate(PageQuery $query = null): \Generator
    {
        $query ??= PageQuery::create();

        do {
            $collection = $this->getPage($query);

            yield from $collection;

            $query->incrementPage();
        } while (!$collection->empty());
    }

    protected static function getDataClass(): string
    {
        return Product::class;
    }
}

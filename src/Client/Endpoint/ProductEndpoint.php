<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Collection;
use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Product\Product;
use Setono\PeakWMS\Request\Query\KeySetPageQuery;

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
     * @use UpdatableEndpointTrait<Product>
     */
    use UpdatableEndpointTrait;

    /**
     * @return PaginatedCollection<Product>
     */
    public function getPage(KeySetPageQuery $query = null): PaginatedCollection
    {
        $query ??= KeySetPageQuery::create();

        /** @var class-string<PaginatedCollection<Product>> $signature */
        $signature = sprintf('%s<%s>', PaginatedCollection::class, self::getDataClass());

        return $this
            ->mapperBuilder
            ->mapper()
            ->map(
                $signature,
                $this->createSource(
                    $this->client->get(sprintf('%s/keySet', $this->endpoint), $query),
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
    public function iterate(KeySetPageQuery $query = null): \Generator
    {
        $query ??= KeySetPageQuery::create();

        do {
            $collection = $this->getPage($query);

            $lastId = null;

            foreach ($collection as $item) {
                yield $item;
                $lastId = $item->id;
            }

            if (null !== $lastId) {
                $query->setLastId($lastId);
            }
        } while (!$collection->empty());
    }

    protected static function getDataClass(): string
    {
        return Product::class;
    }
}

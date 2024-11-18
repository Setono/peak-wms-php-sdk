<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\PaginatedCollection;
use Setono\PeakWMS\DataTransferObject\Stock\Stock;
use Setono\PeakWMS\Request\Query\KeySetPageQuery;

/**
 * @extends Endpoint<Stock>
 */
final class StockEndpoint extends Endpoint implements StockEndpointInterface
{
    /**
     * @return PaginatedCollection<Stock>
     */
    public function getPage(KeySetPageQuery $query = null): PaginatedCollection
    {
        $query ??= KeySetPageQuery::create();

        /** @var class-string<PaginatedCollection<Stock>> $signature */
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

    /**
     * @return \Generator<Stock>
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
        return Stock::class;
    }
}

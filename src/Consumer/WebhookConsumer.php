<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Consumer;

use CuyZ\Valinor\MapperBuilder;
use Setono\PeakWMS\DataTransferObject\Webhook\Name;
use Setono\PeakWMS\DataTransferObject\Webhook\WebhookDataPickOrderPacked;
use Setono\PeakWMS\DataTransferObject\Webhook\WebhookDataStockAdjust;

final class WebhookConsumer implements WebhookConsumerInterface
{
    private ?MapperBuilder $mapperBuilder = null;

    public function consume(string $json, string $dataClass): object
    {
        return $this
            ->getMapperBuilder()
            ->mapper()
            ->map(
                $dataClass,
                json_decode($json, true, 512, \JSON_THROW_ON_ERROR),
            );
    }

    public function setMapperBuilder(MapperBuilder $mapperBuilder): void
    {
        $this->mapperBuilder = $mapperBuilder;
    }

    public function getMapperBuilder(): MapperBuilder
    {
        if (null === $this->mapperBuilder) {
            $this->mapperBuilder = (new MapperBuilder())
                ->allowSuperfluousKeys()
            ;
        }

        return $this->mapperBuilder;
    }

    /**
     * @return class-string
     */
    public static function convertNameToDataClass(Name|int $name): string
    {
        if (is_int($name)) {
            $name = Name::from($name);
        }

        return match ($name) {
            Name::StockAdjust => WebhookDataStockAdjust::class,
            Name::PickOrderPacked => WebhookDataPickOrderPacked::class,
            default => throw new \InvalidArgumentException(sprintf('The name "%d" is not supported', $name->value)),
        };
    }
}

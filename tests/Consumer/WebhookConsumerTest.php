<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Consumer;

use PHPUnit\Framework\TestCase;
use Setono\PeakWMS\DataTransferObject\Webhook\Name;
use Setono\PeakWMS\DataTransferObject\Webhook\WebhookDataStockAdjust;

final class WebhookConsumerTest extends TestCase
{
    /**
     * @test
     */
    public function it_converts_name_to_data_class(): void
    {
        self::assertSame(WebhookDataStockAdjust::class, WebhookConsumer::convertNameToDataClass(100));
        self::assertSame(WebhookDataStockAdjust::class, WebhookConsumer::convertNameToDataClass(Name::StockAdjust));
    }
}

<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

final class WebhookDataPickOrderPacked
{
    public function __construct(
        /** The host id of the sales order */
        public string $orderId,
        /** The PeakWMS internal id of the pick order */
        public int $pickOrderId,
        public bool $paymentCaptured,
        /** @var list<WebhookDataPickOrderLine> $orderLines */
        public array $orderLines,
        public ?string $trackingNumber = null,
        public ?string $trackingUrl = null,
    ) {
    }
}

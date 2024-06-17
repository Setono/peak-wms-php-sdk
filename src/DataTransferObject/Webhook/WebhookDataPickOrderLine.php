<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

final class WebhookDataPickOrderLine
{
    public function __construct(
        /** The host id of the sales order line */
        public string $orderLineId,
        /**
         * The quantity that was picked/packed on the line. If PickOrderPacked webhook then this is the packed quantity.
         * If PickOrderPicked webhook then this is the picked quantity
         */
        public int $quantity,
    ) {
    }
}

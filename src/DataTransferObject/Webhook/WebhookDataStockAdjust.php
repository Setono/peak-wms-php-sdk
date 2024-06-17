<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

final class WebhookDataStockAdjust
{
    public function __construct(
        public string $productId,
        public int $adjustedQuantity,
        public int $quantity,
        public ?string $variantId = null,
        public ?string $stockHostIdentifier = null,
        public ?string $warehouseHostId = null,
        public ?string $lotNumber = null,
        public ?int $adjustmentReason = null,
        public ?int $stockItemId = null,
    ) {
    }
}

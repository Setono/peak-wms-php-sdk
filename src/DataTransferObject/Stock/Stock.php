<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Stock;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

final class Stock extends AbstractDataTransferObject
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?string $productId = null,
        public readonly ?string $variantId = null,
        public readonly ?string $itemNumber = null,
        public readonly ?int $quantity = null,
        public readonly ?int $reservedQuantity = null,
    ) {
    }
}

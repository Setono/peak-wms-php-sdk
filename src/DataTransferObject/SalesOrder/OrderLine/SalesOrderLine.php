<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder\OrderLine;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

final class SalesOrderLine extends AbstractDataTransferObject
{
    public string $orderLineId;

    public string $productId;

    public ?string $variantId;

    public function __construct(
        int|string|null $orderLineId = null,
        /**
         * @var positive-int|null $quantityRequested
         */
        public ?int $quantityRequested = null,
        int|string|null $productId = null,
        public ?string $lotNumber = null,
        int|string $variantId = null,
        public ?string $pickingSequenceName = null,
        public ?string $giftWrapColor = null,
        public ?float $salesPricePiece = null,
        public ?float $salesPriceTaxPiece = null,
        public ?float $salesDiscountPiece = null,
        public ?float $salesDiscountTaxPiece = null,
        public ?string $comments = null,
        public ?State $state = null,
        public ?int $materialId = null,
        public ?int $sendAgainQuantity = null,
    ) {
        $this->orderLineId = (string) $orderLineId;
        $this->productId = (string) $productId;
        $this->variantId = (string) $variantId;
    }
}

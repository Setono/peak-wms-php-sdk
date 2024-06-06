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
        int|string $orderLineId,
        /**
         * @var positive-int $quantityRequested
         */
        public int $quantityRequested,
        int|string $productId,
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
        $this->variantId = null === $variantId ? null : (string) $variantId;
    }
}

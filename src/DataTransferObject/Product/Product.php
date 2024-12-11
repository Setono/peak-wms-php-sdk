<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Product;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

final class Product extends AbstractDataTransferObject
{
    public function __construct(
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
        public ?int $id = null,
        public ?string $productId = null,
        public ?string $variantId = null,
        public ?string $itemNumber = null,
        public ?string $description = null,
        public ?string $comment = null,
        public ?string $countryOfOrigin = null,
        public ?string $quantityInUnits = null,
        public ?string $units = null,
        /**
         * @var list<array{code: string}>|null
         */
        public ?array $customsTariffs = null,
        public ?string $imagePath = null,
        public ?string $ean = null,
        public ?int $state = null,
        public ?int $pickType = null,
        public ?int $cycleCountThreshold = null,
        public ?int $cycleCountInterval = null,
        public ?int $weight = null,
        public ?int $netWeight = null,
        public ?int $volume = null,
        public ?int $length = null,
        public ?int $width = null,
        public ?int $height = null,
        public ?float $averageCostPrice = null,
        public ?float $costPricePiece = null,
        public ?float $salesPricePerPiece = null,
        public ?bool $bestBeforeDateControlled = null,
        public ?bool $lotNumberControlled = null,
        public ?bool $lotRequiredForOrder = null,
        public ?bool $includeInPoForecast = null,
        public ?string $variantMaster = null,
        public ?int $minStockThreshold = null,
        public ?int $maxStockThreshold = null,
        public ?string $brand = null,
        public ?int $availableToSell = null,
        public ?int $availableInStock = null,
        public ?int $orderedByCustomers = null,
        public ?bool $production = null,
        public ?bool $autoAssignLot = null,
        /** @var list<array{name: string, vendorName: string|null}>|null */
        public ?array $vendors = null,
        /** @var list<string>|null */
        public ?array $allowedAreas = null,
        public ?string $dangerousGoodsClass = null,
        public ?string $size = null,
        public ?string $composition = null,
        public ?string $collection = null,
        public ?string $sizeRange = null,
        public ?string $styleNumber = null,
        public ?string $styleDescription = null,
        public ?string $colorNumber = null,
        public ?string $colorDescription = null,
        public ?string $productGroup = null,
    ) {
    }
}

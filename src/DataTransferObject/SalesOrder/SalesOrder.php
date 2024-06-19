<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

use DateTimeImmutable;
use DateTimeInterface;
use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;
use Setono\PeakWMS\DataTransferObject\Address;
use Setono\PeakWMS\DataTransferObject\SalesOrder\OrderLine\SalesOrderLine;

/**
 * See https://api.peakwms.com/api/documentation/index.html#model-SalesOrder
 */
final class SalesOrder extends AbstractDataTransferObject
{
    public string $orderId;

    public string $orderNumber;

    public ?DateTimeImmutable $orderDateTime = null;

    public ?DateTimeImmutable $requestedDeliveryDate = null;

    /**
     * @param list<SalesOrderLine> $orderLines
     */
    public function __construct(
        /** Internal ID for order in PeakWMS */
        protected ?int $id = null,
        /** The ID of the order in the host system. This ID is used by PeakWMS webhooks to report back on the order. */
        int|string|null $orderId = null,
        public ?string $forwarderProductId = null,
        /** Running Order Number. This can be different from OrderId. */
        int|string|null $orderNumber = null,
        public ?Address $billingAddress = null,
        public ?string $comment = null,
        public ?string $webshopComment = null,
        public ?string $parcelShopId = null,
        DateTimeInterface|string $orderDateTime = null,
        DateTimeInterface|string $requestedDeliveryDate = null,
        /** @var int<1, 10>|null $priority */
        public ?int $priority = null,
        public ?State $state = null,
        public ?OnHoldReason $onHoldReason = null,
        public ?string $paymentMethod = null,
        public ?float $paymentFee = null,
        public ?float $paymentFeeTax = null,
        public ?float $currencyDifference = null,
        /**
         * A valid currency ISO code
         */
        public ?string $salesCurrency = null,
        public ?float $shippingCost = null,
        public ?float $shippingTaxCost = null,
        public ?float $discountCost = null,
        public ?float $discountTaxCost = null,
        public ?float $totalSalesPrice = null,
        /**
         * Transaction number that is used to capture or refund transaction in through the payment integration.
         * It is very important that this transaction number is referencing directly to the transaction that can be captured or refunded.
         * Otherwise, PeakWMS will not be able to find and capture the order in the payment integration.
         */
        public ?string $transactionNumber = null,
        public bool $giftWrap = false,
        public ?string $customerReference = null,
        public ?PaymentStatus $paymentStatus = null,
        public ?PickAgainReason $pickAgainReason = null,
        public ?string $storeId = null,
        public ?Address $shippingAddress = null,
        public ?Address $senderAddress = null,
        public ?string $sendWithOrder = null,
        public bool $generateAndPrintDeliveryNote = false,
        /** @var list<SalesOrderLine> $orderLines */
        public array $orderLines = [],
    ) {
        $this->orderId = (string) $orderId;
        $this->orderNumber = (string) $orderNumber;
        $this->orderDateTime = self::convertDateTime($orderDateTime);
        $this->requestedDeliveryDate = self::convertDateTime($requestedDeliveryDate);
    }
}

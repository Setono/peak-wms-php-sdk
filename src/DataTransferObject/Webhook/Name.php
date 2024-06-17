<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

enum Name: int
{
    /**
     * Event is triggered on a stock adjustment, and data will include information about the product and new quantity.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataStockAdjust is returned in the webhook data.
     */
    case StockAdjust = 100;

    /**
     * Event is triggered on change on product EAN, and will include information about the product and new EAN.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataUpdateEan is returned in the webhook data.
     */
    case EanUpdates = 101;

    /**
     * Event is triggered when a pick order is packed, and will include information about the sales order (orderId), tracking info, and the packed lines.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataPickOrderPacked is returned in the webhook data.
     */
    case PickOrderPacked = 102;

    /**
     * Event is triggered when an inbound order with a set warehouse is closed and will update all warehouse host locations separately.
     * A Domain.DataTransferObjects.OpenApi.PurchaseOrder is returned in the webhook data.
     */
    case InboundOrderClosed = 103;

    /**
     * Event is triggered when a refund is performed and will include information about the refunded sales order.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataOrderRefunded is returned in the webhook data.
     */
    case OrderRefunded = 104;

    /**
     * Event is triggered when a product is created or updated.
     * A Domain.DataTransferObjects.OpenApi.Product is returned in the webhook data.
     */
    case ProductCreateUpdate = 105;

    /**
     * Event is triggered when fulfillment is not possible of a product that should be produced.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataFulfillmentNotPossible is returned in the webhook data.
     */
    case FulfillmentNotPossible = 106;

    /**
     * Event is triggered when an inbound delivery is closed.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataInboundDeliveryClosed is returned in the webhook data.
     */
    case InboundDeliveryClosed = 107;

    /**
     * Event is triggered when order is sent again.
     * A Domain.DataTransferObjects.OpenApi.SalesOrder is returned in the webhook data.
     */
    case OrderSendAgain = 108;

    /**
     * Event is triggered when order state is changed as part of the order release.
     * A Domain.DataTransferObjects.OpenApi.SalesOrder is returned in the webhook data.
     */
    case OrderStateChanged = 109;

    /**
     * Event is triggered when a pick orders is fully picked, and will include information about the sales order (orderId) and tracking info (if available).
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataPickOrderPicked is returned in the webhook data.
     */
    case PickOrderPicked = 110;

    /**
     * Event is triggered when the delivery date change on a purchase order affects a sales order.
     * A Domain.DataTransferObjects.OpenApi.WebhookData.WebhookDataExpectedDeliveryChanged is returned in the webhook data.
     */
    case ExpectedDeliveryChanged = 111;
}

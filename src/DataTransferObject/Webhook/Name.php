<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

enum Name: int
{
    case StockAdjust = 100;
    case EanUpdates = 101;
    case PickOrderPacked = 102;
    case InboundOrderClosed = 103;
    case OrderRefunded = 104;
    case ProductCreateUpdate = 105;
    case FulfillmentNotPossible = 106;
    case InboundDeliveryClosed = 107;
    case OrderSendAgain = 108;
    case OrderStateChanged = 109;
    case PickOrderFullyPacked = 110;
}

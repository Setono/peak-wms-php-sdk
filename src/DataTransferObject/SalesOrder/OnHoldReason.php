<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

enum OnHoldReason: int
{
    case WaitingForPayment = 0;
    case Manual = 1;
    case InvalidMaterial = 2;
    case MissingNetWeight = 3;
    case MissingOrigin = 4;
    case MissingCustomsTariff = 5;
    case MissingVatOrCustomsNo = 6;
    case NoStock = 7;
    case NoStockAvailableReservedForOther = 8;
    case SetByHostMapping = 9;
    case CommentOnOrder = 10;
    case DueToCountry = 11;
    case MissingCustomsDescription = 12;
    case WaitingForReplenishment = 13;
    case MissingForwarderProduct = 14;
    case WaitingForReturn = 15;
    case ErrorInReturn = 16;
    case Preorder = 17;
    case SetByHost = 18;
    case IncorrectAddress = 19;
    case HighRiskOfFraud = 20;
    case NoStockAvailableInPickingWarehouse = 21;
    case MissingDeliveryDate = 22;
    case WaitingForProduction = 23;
    case MissingLotNumber = 24;
}

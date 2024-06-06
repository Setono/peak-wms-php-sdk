<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

enum OnHoldReason: int
{
    /**
    WAITING_FOR_PAYMENT = 0
    MANUAL = 1
    INVALID_MATERIAL = 2
    MISSING_NET_WEIGHT = 3
    MISSING_ORIGIN = 4
    MISSING_CUSTOMS_TARIFF = 5
    MISSING_VAT_OR_CUSTOMS_NO = 6
    NO_STOCK = 7
    NO_STOCK_AVAILABLE_RESERVED_FOR_OTHER = 8
    SET_BY_HOST_MAPPING = 9
    COMMENT_ON_ORDER = 10
    DUE_TO_COUNTRY = 11
    MISSING_CUSTOMS_DESCRIPTION = 12
    WAITING_FOR_REPLENISHMENT = 13
    MISSING_FORWARDER_PRODUCT = 14
    WAITING_FOR_RETURN = 15
    ERROR_IN_RETURN = 16
    PREORDER = 17
    SET_BY_HOST = 18
    INCORRECT_ADDRESS = 19
    HIGH_RISK_OF_FRAUD = 20
    NO_STOCK_AVAILABLE_IN_PICKING_WAREHOUSE = 21
    MISSING_DELIVERY_DATE = 22
    WAITING_FOR_PRODUCTION = 23
    MISSING_LOT_NUMBER = 24
     */
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

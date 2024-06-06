<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

enum State: int
{
    case Created = 0;
    case Released = 1;
    case Picked = 2;
    case Packed = 3;
    case Shipped = 4;
    case Cancelled = 5;
    case Error = 6;
    case OnHold = 7;
    case DropShip = 8;

    // This is not documented in their API docs, but the value '9' is a valid state that indicates the order is sent together with another order.
    case SentTogether = 9;
}

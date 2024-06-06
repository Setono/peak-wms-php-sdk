<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

enum PaymentStatus: int
{
    case Pending = 0;
    case Authorized = 1;
    case Captured = 2;
    case Refunded = 3;
}

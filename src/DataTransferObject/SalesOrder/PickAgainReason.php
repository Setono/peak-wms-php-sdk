<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

enum PickAgainReason: int
{
    case Damaged = 0;
    case WrongDelivery = 1;
    case PackageMissing = 2;
    case Other = 3;
    case WrongPick = 4;
}

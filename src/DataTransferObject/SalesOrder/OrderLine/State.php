<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder\OrderLine;

enum State: int
{
    case Created = 0;
    case Picked = 1;
    case Packed = 2;
    case Cancelled = 3;
    case NoStock = 4;
    case DropShip = 5;
    case Packaging = 6;
}

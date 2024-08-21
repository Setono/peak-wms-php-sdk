<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\SalesOrder\SalesOrder;

/**
 * @extends EndpointInterface<SalesOrder>
 * @extends CreatableEndpointInterface<SalesOrder>
 * @extends UpdatableEndpointInterface<SalesOrder>
 */
interface SalesOrderEndpointInterface extends EndpointInterface, CreatableEndpointInterface, DeletableEndpointInterface, UpdatableEndpointInterface
{
}

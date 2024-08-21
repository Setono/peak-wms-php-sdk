<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\SalesOrder\SalesOrder;

/**
 * @extends Endpoint<SalesOrder>
 */
final class SalesOrderEndpoint extends Endpoint implements SalesOrderEndpointInterface
{
    /**
     * @use CreatableEndpointTrait<SalesOrder>
     */
    use CreatableEndpointTrait;

    use DeletableEndpointTrait;

    /**
     * @use UpdatableEndpointTrait<SalesOrder>
     */
    use UpdatableEndpointTrait;

    protected static function getDataClass(): string
    {
        return SalesOrder::class;
    }
}

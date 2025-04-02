<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\SalesOrder\SalesOrder;
use Setono\PeakWMS\Exception\BadRequestException;

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

    public function cancel(string $id): void
    {
        try {
            $this->client->put(sprintf('%s/%s/cancel', $this->endpoint, $id));
        } catch (BadRequestException $e) {
            if (!str_contains($e->getMessage(), 'cannot be cancelled because it is in state CANCELLED')) {
                throw $e;
            }
        }
    }

    protected static function getDataClass(): string
    {
        return SalesOrder::class;
    }
}

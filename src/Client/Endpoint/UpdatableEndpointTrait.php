<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * @mixin Endpoint
 *
 * @template T of AbstractDataTransferObject
 */
trait UpdatableEndpointTrait
{
    /**
     * @param T|AbstractDataTransferObject $data
     */
    public function update(AbstractDataTransferObject $data, mixed $id = null): void
    {
        $endpoint = null === $id ? $this->endpoint : sprintf('%s/%s', $this->endpoint, (string) $id);
        $this->client->put($endpoint, $data);
    }
}

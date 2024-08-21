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
    public function update(mixed $id, AbstractDataTransferObject $data): void
    {
        $this->client->put(sprintf('%s/%s', $this->endpoint, (string) $id), $data);
    }
}

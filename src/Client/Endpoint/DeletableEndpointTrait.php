<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

/**
 * @mixin Endpoint
 */
trait DeletableEndpointTrait
{
    public function delete(int $id): void
    {
        $this->client->delete($this->endpoint, $id);
    }
}

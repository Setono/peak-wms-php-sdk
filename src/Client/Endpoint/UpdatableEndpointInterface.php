<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 */
interface UpdatableEndpointInterface
{
    /**
     * @param mixed|null $id This is (most likely) the host id. Some endpoints require this to be set
     */
    public function update(AbstractDataTransferObject $data, mixed $id = null): void;
}

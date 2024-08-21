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
     * @param mixed $id This is (most likely) the host id
     */
    public function update(mixed $id, AbstractDataTransferObject $data): void;
}

<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 */
interface CreatableEndpointInterface
{
    /**
     * @return T
     */
    public function create(AbstractDataTransferObject $data): AbstractDataTransferObject;
}

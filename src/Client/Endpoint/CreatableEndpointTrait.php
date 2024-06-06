<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * @mixin Endpoint
 *
 * @template T of AbstractDataTransferObject
 */
trait CreatableEndpointTrait
{
    /**
     * @return T
     */
    public function create(AbstractDataTransferObject $data): AbstractDataTransferObject
    {
        return $this
            ->mapperBuilder
            ->mapper()
            ->map(
                self::getResponseClass(),
                $this->createSource(
                    $this->client->post($this->endpoint, $data),
                ),
            );
    }
}

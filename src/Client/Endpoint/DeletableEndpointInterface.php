<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

interface DeletableEndpointInterface
{
    public function delete(int $id): void;
}

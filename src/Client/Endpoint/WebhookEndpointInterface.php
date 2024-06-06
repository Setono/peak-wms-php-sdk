<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Webhook\Webhook;

/**
 * @extends EndpointInterface<Webhook>
 * @extends CreatableEndpointInterface<Webhook>
 */
interface WebhookEndpointInterface extends EndpointInterface, CreatableEndpointInterface, DeletableEndpointInterface
{
}

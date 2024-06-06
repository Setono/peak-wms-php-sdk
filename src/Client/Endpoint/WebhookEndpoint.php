<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use Setono\PeakWMS\DataTransferObject\Webhook\Webhook;

/**
 * @extends Endpoint<Webhook>
 */
final class WebhookEndpoint extends Endpoint implements WebhookEndpointInterface
{
    /**
     * @use CreatableEndpointTrait<Webhook>
     */
    use CreatableEndpointTrait;

    use DeletableEndpointTrait;

    protected static function getDataClass(): string
    {
        return Webhook::class;
    }
}

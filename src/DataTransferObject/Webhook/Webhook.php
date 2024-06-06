<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\Webhook;

use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * See https://api.peakwms.com/api/documentation/index.html#model-WebhookDto
 */
final class Webhook extends AbstractDataTransferObject
{
    public function __construct(
        public Name $name,
        public string $url,
        public ?int $id = null,
    ) {
    }
}

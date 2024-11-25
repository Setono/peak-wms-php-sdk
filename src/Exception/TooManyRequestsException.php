<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Exception;

use Psr\Http\Message\ResponseInterface;

final class TooManyRequestsException extends ResponseAwareException
{
    public static function assert(ResponseInterface $response): void
    {
        if ($response->getStatusCode() === 429) {
            throw new self($response);
        }
    }
}

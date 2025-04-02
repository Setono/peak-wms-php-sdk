<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Exception;

use Psr\Http\Message\ResponseInterface;

abstract class ResponseAwareException extends \RuntimeException
{
    private ResponseInterface $response;

    private int $statusCode;

    public function __construct(ResponseInterface $response)
    {
        $body = (string) $response->getBody();
        $message = sprintf('The request failed with status code %d and body: %s', $response->getStatusCode(), $body);

        if ('' !== $body) {
            try {
                /** @var mixed $data */
                $data = json_decode($body, true, 512, \JSON_THROW_ON_ERROR);
                if (is_array($data) && isset($data['message']) && is_string($data['message'])) {
                    $message = $data['message'];
                }
            } catch (\JsonException) {
            }
        }

        parent::__construct($message);

        $this->response = $response;
        $this->statusCode = $response->getStatusCode();
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}

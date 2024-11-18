<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client\Endpoint;

use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\MapperBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Setono\PeakWMS\Client\ClientInterface;
use Setono\PeakWMS\DataTransferObject\AbstractDataTransferObject;

/**
 * @template T of AbstractDataTransferObject
 * @implements EndpointInterface<T>
 */
abstract class Endpoint implements EndpointInterface, LoggerAwareInterface
{
    protected LoggerInterface $logger;

    public function __construct(
        protected readonly ClientInterface $client,
        protected readonly MapperBuilder $mapperBuilder,
        protected readonly string $endpoint,
    ) {
        $this->logger = new NullLogger();
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * Takes a response and returns a Valinor Source representation
     */
    protected function createSource(ResponseInterface $response): Source
    {
        try {
            return Source::json((string) $response->getBody());
        } catch (\Throwable $e) {
            $lastRequest = $this->client->getLastRequest();

            $message = sprintf('There was an error turning the JSON into a Source representation. The error was: %s.', $e->getMessage());

            if (null !== $lastRequest) {
                $message .= sprintf(' The request was %s %s', $lastRequest->getMethod(), (string) $lastRequest->getUri());
            }

            $message .= sprintf("The inputted JSON was:\n%s", (string) $response->getBody());

            $this->logger->error($message);

            throw $e;
        }
    }

    /**
     * @return class-string<T>
     */
    abstract protected static function getDataClass(): string;
}

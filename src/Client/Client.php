<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client;

use CuyZ\Valinor\MapperBuilder;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Setono\PeakWMS\Client\Endpoint\ProductEndpoint;
use Setono\PeakWMS\Client\Endpoint\ProductEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\SalesOrderEndpoint;
use Setono\PeakWMS\Client\Endpoint\SalesOrderEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\StockEndpoint;
use Setono\PeakWMS\Client\Endpoint\StockEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\WebhookEndpoint;
use Setono\PeakWMS\Client\Endpoint\WebhookEndpointInterface;
use Setono\PeakWMS\Exception\BadRequestException;
use Setono\PeakWMS\Exception\InternalServerErrorException;
use Setono\PeakWMS\Exception\NotAuthorizedException;
use Setono\PeakWMS\Exception\NotFoundException;
use Setono\PeakWMS\Exception\TooManyRequestsException;
use Setono\PeakWMS\Exception\UnexpectedStatusCodeException;
use Setono\PeakWMS\Request\Query\Query;

final class Client implements ClientInterface, LoggerAwareInterface
{
    private bool $sandbox = false;

    private ?RequestInterface $lastRequest = null;

    private ?ResponseInterface $lastResponse = null;

    private ?ProductEndpointInterface $productEndpoint = null;

    private ?SalesOrderEndpointInterface $salesOrderEndpoint = null;

    private ?StockEndpointInterface $stockEndpoint = null;

    private ?WebhookEndpointInterface $webhookEndpoint = null;

    private ?HttpClientInterface $httpClient = null;

    private ?RequestFactoryInterface $requestFactory = null;

    private ?StreamFactoryInterface $streamFactory = null;

    private LoggerInterface $logger;

    private ?MapperBuilder $mapperBuilder = null;

    public function __construct(private readonly string $apiKey)
    {
        $this->logger = new NullLogger();
    }

    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function request(RequestInterface $request): ResponseInterface
    {
        $request = $request->withHeader(
            'Authorization',
            sprintf('Bearer %s', $this->apiKey),
        )->withHeader('Accept', 'application/json');

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'])) {
            $request = $request->withHeader('Content-Type', 'application/json');
        }

        $this->lastRequest = $request;
        $this->lastResponse = $this->getHttpClient()->sendRequest($this->lastRequest);

        self::assertStatusCode($this->lastResponse);

        return $this->lastResponse;
    }

    public function get(string $uri, Query|array $query = []): ResponseInterface
    {
        if (is_array($query)) {
            $query = new Query($query);
        }

        $url = sprintf(
            '%s/%s%s',
            $this->getBaseUri(),
            ltrim($uri, '/'),
            $query->isEmpty() ? '' : '?' . $query->toString(),
        );

        return $this->request($this->getRequestFactory()->createRequest('GET', $url));
    }

    public function post(string $uri, array|object $body): ResponseInterface
    {
        $url = sprintf('%s/%s', $this->getBaseUri(), ltrim($uri, '/'));

        $request = $this->getRequestFactory()
            ->createRequest('POST', $url)
            ->withBody(
                $this->getStreamFactory()
                    ->createStream(json_encode($body, \JSON_THROW_ON_ERROR)),
            )
        ;

        return $this->request($request);
    }

    public function put(string $uri, array|object $body = null): ResponseInterface
    {
        $request = $this
            ->getRequestFactory()
            ->createRequest('PUT', sprintf('%s/%s', $this->getBaseUri(), ltrim($uri, '/')))
        ;

        if (null !== $body) {
            $request = $request->withBody(
                $this->getStreamFactory()->createStream(json_encode($body, \JSON_THROW_ON_ERROR)),
            );
        }

        return $this->request($request);
    }

    public function delete(string $uri, int $id): ResponseInterface
    {
        $url = sprintf('%s/%s/%d', $this->getBaseUri(), ltrim($uri, '/'), $id);

        return $this->request($this->getRequestFactory()->createRequest('DELETE', $url));
    }

    public function ping(): void
    {
        $this->get('ping');
    }

    public function product(): ProductEndpointInterface
    {
        if (null === $this->productEndpoint) {
            $this->productEndpoint = new ProductEndpoint($this, $this->getMapperBuilder(), 'product');
            $this->productEndpoint->setLogger($this->logger);
        }

        return $this->productEndpoint;
    }

    public function salesOrder(): SalesOrderEndpointInterface
    {
        if (null === $this->salesOrderEndpoint) {
            $this->salesOrderEndpoint = new SalesOrderEndpoint($this, $this->getMapperBuilder(), 'salesOrder');
            $this->salesOrderEndpoint->setLogger($this->logger);
        }

        return $this->salesOrderEndpoint;
    }

    public function stock(): StockEndpointInterface
    {
        if (null === $this->stockEndpoint) {
            $this->stockEndpoint = new StockEndpoint($this, $this->getMapperBuilder(), 'stock');
            $this->stockEndpoint->setLogger($this->logger);
        }

        return $this->stockEndpoint;
    }

    public function webhook(): WebhookEndpointInterface
    {
        if (null === $this->webhookEndpoint) {
            $this->webhookEndpoint = new WebhookEndpoint($this, $this->getMapperBuilder(), 'webhook');
            $this->webhookEndpoint->setLogger($this->logger);
        }

        return $this->webhookEndpoint;
    }

    public function setMapperBuilder(MapperBuilder $mapperBuilder): void
    {
        $this->mapperBuilder = $mapperBuilder;
    }

    public function getMapperBuilder(): MapperBuilder
    {
        if (null === $this->mapperBuilder) {
            $this->mapperBuilder = (new MapperBuilder())
                ->allowSuperfluousKeys()
            ;
        }

        return $this->mapperBuilder;
    }

    public function setHttpClient(?HttpClientInterface $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    public function setRequestFactory(?RequestFactoryInterface $requestFactory): void
    {
        $this->requestFactory = $requestFactory;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * When set to true, the client will use the sandbox environment
     */
    public function useSandbox(bool $sandbox = true): void
    {
        $this->sandbox = $sandbox;
    }

    private function getBaseUri(): string
    {
        return sprintf('https://%s.peakwms.com/api/integration/v1', $this->sandbox ? 'api-test' : 'api');
    }

    private function getHttpClient(): HttpClientInterface
    {
        if (null === $this->httpClient) {
            $this->httpClient = Psr18ClientDiscovery::find();
        }

        return $this->httpClient;
    }

    private function getRequestFactory(): RequestFactoryInterface
    {
        if (null === $this->requestFactory) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }

        return $this->requestFactory;
    }

    private function getStreamFactory(): StreamFactoryInterface
    {
        if (null === $this->streamFactory) {
            $this->streamFactory = Psr17FactoryDiscovery::findStreamFactory();
        }

        return $this->streamFactory;
    }

    private static function assertStatusCode(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode < 300) {
            return;
        }

        BadRequestException::assert($response);
        NotAuthorizedException::assert($response);
        NotFoundException::assert($response);
        TooManyRequestsException::assert($response);
        InternalServerErrorException::assert($response);

        throw new UnexpectedStatusCodeException($response);
    }
}

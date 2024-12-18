<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Setono\PeakWMS\Client\Endpoint\ProductEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\SalesOrderEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\StockEndpointInterface;
use Setono\PeakWMS\Client\Endpoint\WebhookEndpointInterface;
use Setono\PeakWMS\Exception\InternalServerErrorException;
use Setono\PeakWMS\Exception\NotFoundException;
use Setono\PeakWMS\Exception\UnexpectedStatusCodeException;
use Setono\PeakWMS\Request\Query\Query;

interface ClientInterface
{
    /**
     * Returns the last http request sent to the API if any requests has been sent
     */
    public function getLastRequest(): ?RequestInterface;

    /**
     * Returns the last http response from the API, if any responses has been received
     */
    public function getLastResponse(): ?ResponseInterface;

    /**
     * @throws ClientExceptionInterface if an error happens while processing the request
     * @throws InternalServerErrorException if the server reports an internal server error
     * @throws NotFoundException if the request results in a 404
     * @throws UnexpectedStatusCodeException if the status code is not between 200 and 299, and it's not any of the above
     */
    public function request(RequestInterface $request): ResponseInterface;

    /**
     * @param Query|array<string, scalar|\Stringable|\DateTimeInterface|null> $query The query parameters. Parameters with null values are removed.
     *
     * @throws ClientExceptionInterface if an error happens while processing the request
     * @throws InternalServerErrorException if the server reports an internal server error
     * @throws NotFoundException if the request results in a 404
     * @throws UnexpectedStatusCodeException if the status code is not between 200 and 299, and it's not any of the above
     */
    public function get(string $uri, Query|array $query = []): ResponseInterface;

    public function post(string $uri, array|object $body): ResponseInterface;

    public function put(string $uri, array|object $body = null): ResponseInterface;

    public function delete(string $uri, int $id): ResponseInterface;

    /**
     * Will try to ping the Peak WMS API
     */
    public function ping(): void;

    public function product(): ProductEndpointInterface;

    public function salesOrder(): SalesOrderEndpointInterface;

    public function stock(): StockEndpointInterface;

    public function webhook(): WebhookEndpointInterface;
}

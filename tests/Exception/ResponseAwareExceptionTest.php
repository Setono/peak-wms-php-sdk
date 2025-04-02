<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Exception;

use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Psr\Http\Message\ResponseInterface;

final class ResponseAwareExceptionTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     */
    public function it_handles_json_response(): void
    {
        $response = $this->prophesize(ResponseInterface::class);
        $response->getStatusCode()->willReturn(400);
        $response->getBody()->willReturn('{"message":"OpenApi -> Order 1001127819 (CANCELLED) cannot be cancelled because it is in state CANCELLED","messageKey":null,"parameters":null,"errorCode":"4148","translateParams":false}');

        $exception = new ConcreteResponseAwareException($response->reveal());

        self::assertSame(400, $exception->getStatusCode());
        self::assertSame('OpenApi -> Order 1001127819 (CANCELLED) cannot be cancelled because it is in state CANCELLED', $exception->getMessage());
    }

    /**
     * @test
     */
    public function it_handles_non_json_response(): void
    {
        $response = $this->prophesize(ResponseInterface::class);
        $response->getStatusCode()->willReturn(400);
        $response->getBody()->willReturn('The API failed');

        $exception = new ConcreteResponseAwareException($response->reveal());

        self::assertSame(400, $exception->getStatusCode());
        self::assertSame('The request failed with status code 400 and body: The API failed', $exception->getMessage());
    }
}

final class ConcreteResponseAwareException extends ResponseAwareException
{
}

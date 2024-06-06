<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject\SalesOrder;

use PHPUnit\Framework\TestCase;
use Setono\PeakWMS\DataTransferObject\Address;

final class SalesOrderTest extends TestCase
{
    /**
     * @test
     */
    public function it_initializes(): void
    {
        $now = new \DateTimeImmutable();

        $salesOrder = new SalesOrder(
            orderId: 123,
            forwarderProductId: 'gls',
            orderNumber: '123',
            billingAddress: new Address(
                customerName: 'customerName',
                address1: 'address1',
                postalCode: '9000',
                city: 'city',
                country: 'DK',
            ),
            orderDateTime: $now->format(\DATE_ATOM),
            state: 3,
        );

        self::assertSame('123', $salesOrder->orderId);
        self::assertSame('gls', $salesOrder->forwarderProductId);
        self::assertSame('123', $salesOrder->orderNumber);
        self::assertInstanceOf(Address::class, $salesOrder->billingAddress);
        self::assertSame($now->format(\DATE_ATOM), $salesOrder->orderDateTime?->format(\DATE_ATOM));
        self::assertSame(State::Packed, $salesOrder->state);
    }
}

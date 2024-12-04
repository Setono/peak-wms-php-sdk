<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

use PHPUnit\Framework\TestCase;

final class AbstractDataTransferObjectTest extends TestCase
{
    /**
     * @test
     */
    public function it_converts_date_time(): void
    {
        $dt = AbstractDataTransferObjectTestDummy::convertDateTime('2024-12-04T12:35:29+02:00');

        self::assertSame('2024-12-04T12:35:29+02:00', $dt->format(\DATE_ATOM));
    }

    /**
     * @test
     */
    public function it_returns_null_if_input_is_null(): void
    {
        $dt = AbstractDataTransferObjectTestDummy::convertDateTime(null);

        self::assertNull($dt);
    }

    /**
     * @test
     */
    public function it_returns_same_object_if_input_is_date_time(): void
    {
        $dt1 = new \DateTimeImmutable('2024-12-04T12:35:29+02:00');
        $dt2 = AbstractDataTransferObjectTestDummy::convertDateTime($dt1);

        self::assertSame($dt1, $dt2);
    }

    /**
     * @test
     */
    public function it_returns_date_time_immutable_if_input_is_not(): void
    {
        $dt1 = new \DateTime('2024-12-04T12:35:29+02:00');
        $dt2 = AbstractDataTransferObjectTestDummy::convertDateTime($dt1);

        self::assertSame('2024-12-04T12:35:29+02:00', $dt2->format(\DATE_ATOM));
    }

    /**
     * @test
     */
    public function it_throws_if_input_cannot_be_converted(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        AbstractDataTransferObjectTestDummy::convertDateTime('2024-12-04T12:35:29.123456+02:00');
    }
}

final class AbstractDataTransferObjectTestDummy extends AbstractDataTransferObject
{
}

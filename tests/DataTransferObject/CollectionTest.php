<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

use PHPUnit\Framework\TestCase;
use Setono\PeakWMS\DataTransferObject\Stock\Stock;

final class CollectionTest extends TestCase
{
    /**
     * @test
     */
    public function it_sums(): void
    {
        $collection = new Collection([
            new Stock(quantity: 1),
            new Stock(quantity: 3),
            new Stock(quantity: 5),
        ]);

        self::assertSame(9, $collection->sum(fn (Stock $stock): int => (int) $stock->quantity));
    }
}

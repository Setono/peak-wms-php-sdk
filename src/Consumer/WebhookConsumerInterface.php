<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Consumer;

interface WebhookConsumerInterface
{
    /**
     * @template T
     *
     * @param class-string<T> $dataClass
     *
     * @return T
     */
    public function consume(string $json, string $dataClass): object;
}

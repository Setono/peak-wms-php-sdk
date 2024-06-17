<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Parser;

interface WebhookParserInterface
{
    /**
     * @template T
     *
     * @param class-string<T> $dataClass
     *
     * @return T
     */
    public function parse(string $json, string $dataClass): object;
}

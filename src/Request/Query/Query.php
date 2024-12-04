<?php

declare(strict_types=1);

namespace Setono\PeakWMS\Request\Query;

class Query implements \Stringable
{
    /** @var array<string, scalar|\Stringable|\DateTimeInterface> */
    protected array $parameters;

    /**
     * Parameters with null values are removed
     *
     * @param array<string, scalar|\Stringable|\DateTimeInterface|null> $parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = array_filter($parameters, static function ($element) {
            return null !== $element;
        });
    }

    public function isEmpty(): bool
    {
        return [] === $this->parameters;
    }

    public function toString(): string
    {
        return http_build_query(array_map(static function ($element) {
            return $element instanceof \DateTimeInterface ? $element->format(\DATE_ATOM) : (string) $element;
        }, $this->parameters), '', '&', \PHP_QUERY_RFC3986);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

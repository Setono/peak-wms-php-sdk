<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

use Webmozart\Assert\Assert;

abstract class AbstractDataTransferObject implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        $data = array_map(static function (mixed $value): mixed {
            if ($value instanceof \DateTimeInterface) {
                return $value->format(\DATE_ATOM);
            }

            if ($value instanceof \Stringable) {
                return (string) $value;
            }

            return $value;
        }, get_object_vars($this));

        return array_filter($data, static function (mixed $value): bool {
            if (null === $value) {
                return false;
            }

            if (is_string($value)) {
                return '' !== $value;
            }

            return true;
        });
    }

    protected static function convertDateTime(null|\DateTimeImmutable|string $dateTime): ?\DateTimeImmutable
    {
        if (null === $dateTime || $dateTime instanceof \DateTimeImmutable) {
            return $dateTime;
        }

        $dateTime = \DateTimeImmutable::createFromFormat(\DATE_ATOM, $dateTime);
        Assert::notFalse($dateTime);

        return $dateTime;
    }

    /**
     * @template T of \BackedEnum
     *
     * @param int|string|T|null $value
     * @param class-string<T> $enumClass
     *
     * @return T|null
     */
    protected static function convertEnum(null|int|string|\BackedEnum $value, string $enumClass): ?\BackedEnum
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof \BackedEnum) {
            Assert::isInstanceOf($value, $enumClass);

            return $value;
        }

        /** @psalm-suppress PossiblyInvalidArgument */
        return $enumClass::from($value);
    }
}

<?php

declare(strict_types=1);

namespace Setono\PeakWMS\DataTransferObject;

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

    /**
     * @throws \InvalidArgumentException if the value is not a valid date time string
     */
    protected static function convertDateTime(null|\DateTimeImmutable|string $value): ?\DateTimeImmutable
    {
        if (null === $value || $value instanceof \DateTimeImmutable) {
            return $value;
        }

        $res = \DateTimeImmutable::createFromFormat(\DATE_ATOM, $value);
        if (false === $res) {
            throw new \InvalidArgumentException(sprintf('The value %s is not a valid date time string based on the format %s', $value, \DATE_ATOM));
        }

        return $res;
    }

    /**
     * @template T of \BackedEnum
     *
     * @param int|string|T|null $value
     * @param class-string<T> $enumClass
     *
     * @return T|null
     *
     * @throws \InvalidArgumentException if the value is not an instance of the enum class
     */
    protected static function convertEnum(null|int|string|\BackedEnum $value, string $enumClass): ?\BackedEnum
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof \BackedEnum) {
            if (!is_a($value, $enumClass)) {
                throw new \InvalidArgumentException(sprintf('The value %s is not an instance of the enum class %s', $value::class, $enumClass));
            }

            return $value;
        }

        /** @psalm-suppress PossiblyInvalidArgument */
        return $enumClass::from($value);
    }
}

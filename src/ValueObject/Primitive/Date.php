<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Contract\CompositeValueObject;
use Cnastasi\DDD\Contract\Serializable;
use Cnastasi\DDD\Error\InvalidDate;
use DateTimeImmutable;
use DateTimeInterface;

final class Date implements CompositeValueObject, Serializable
{
    private int $days;

    private int $months;

    private int $years;

    public function __construct(int $days, int $months, int $years)
    {
        $this->assertDateIsValid($days, $months, $years);

        $this->days = $days;
        $this->months = $months;
        $this->years = $years;
    }

    public static function now(): Date
    {
        return static::fromDateTimeInterface(new DateTimeImmutable());
    }

    private static function toString(int $years, int $months, int $days): string
    {
        return \sprintf('%4d-%02d-%02d', $years, $months, $days);
    }

    public function getDays(): int
    {
        return $this->days;
    }

    public function getMonths(): int
    {
        return $this->months;
    }

    public function getYears(): int
    {
        return $this->years;
    }

    public function __toString(): string
    {
        return static::toString($this->years, $this->months, $this->days);
    }

    public function toDateTimeInterface(): DateTimeInterface
    {
        return DateTimeImmutable::createFromFormat(DateTimeImmutable::RFC3339, $this->__toString() . 'T00:00:00');
    }

    public static function fromDateTimeInterface(DateTimeInterface $date): Date
    {
        $days = (int)$date->format('d');
        $months = (int)$date->format('m');
        $years = (int)$date->format('Y');

        return new Date($days, $months, $years);
    }

    public static function fromString(string $date, string $format = DateTimeInterface::RFC3339): Date
    {
        return static::fromDateTimeInterface(DateTimeImmutable::createFromFormat($format, $date));
    }

    private function assertDateIsValid(int $days, int $months, int $years): void
    {
        $dateAsString = self::toString($years, $months, $days);

        $date = DateTimeImmutable::createFromFormat('Y-m-d', $dateAsString);

        if ($date === false || $date->format('Y-m-d') !== $dateAsString) {
            throw new InvalidDate($dateAsString);
        }
    }

    public function serialize(): string
    {
        return $this->__toString();
    }
}

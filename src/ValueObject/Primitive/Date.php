<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\ComparableNumber;
use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Contract\Serializable;
use CNastasi\DDD\Contract\Stringable;
use CNastasi\DDD\Error\InvalidDate;
use CNastasi\DDD\ValueObject\ComparableNumberTrait;
use DateTimeImmutable;
use DateTimeInterface;

/**
 * @psalm-immutable
 */
final class Date implements CompositeValueObject, Serializable, Stringable, ComparableNumber
{
    use ComparableNumberTrait;

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

    public static function now(): Date
    {
        return Date::fromDateTimeInterface(new DateTimeImmutable());
    }

    /**
     * @psalm-pure
     */
    private static function toString(int $years, int $months, int $days): string
    {
        return \sprintf('%4d-%02d-%02d', $years, $months, $days);
    }

    public function toDateTime(): DateTime
    {
        return new DateTime($this, new Time(0, 0, 0));
    }

    public function __toString(): string
    {
        return Date::toString($this->years, $this->months, $this->days);
    }

    /**
     * @see toDateTimeImmutable
     */
    public function toDateTimeInterface(): DateTimeInterface
    {
        return $this->toDateTimeImmutable();
    }

    public function toDateTimeImmutable(): \DateTimeImmutable
    {
        $dateAsString = $this->__toString() . 'T00:00:00Z';

        $result = DateTimeImmutable::createFromFormat(DateTimeImmutable::RFC3339, $dateAsString);

        if ($result === false) {
            throw new InvalidDate($dateAsString);
        }

        return $result;
    }

    public static function fromDateTimeInterface(DateTimeInterface $date): self
    {
        $days = (int)$date->format('d');
        $months = (int)$date->format('m');
        $years = (int)$date->format('Y');

        return new Date($days, $months, $years);
    }

    public static function fromString(string $dateAsString, string $format = DateTimeInterface::RFC3339): Date
    {
        $date = DateTimeImmutable::createFromFormat($format, $dateAsString);

        if ($date === false) {
            throw new InvalidDate($dateAsString);
        }

        return Date::fromDateTimeInterface($date);
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

    public function toInt(): int
    {
        return (int)sprintf('%04d%02d%02d000000', $this->years, $this->months, $this->days);
    }
}

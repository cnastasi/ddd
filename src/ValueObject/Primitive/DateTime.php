<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Error\InvalidDate;
use CNastasi\DDD\Error\InvalidDateTime;
use CNastasi\DDD\Error\InvalidTime;
use DateTimeImmutable;

final class DateTime implements CompositeValueObject
{
    public const SIMPLE = 'Y-m-d H:i:s';
    public const RFC3339 = \DateTimeInterface::RFC3339;
    private const DATE_TIME_FORMAT = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';

    private Date $date;

    private Time $time;

    public function __construct(Date $date, Time $time)
    {
        $this->date = $date;
        $this->time = $time;
    }

    public function getDate(): Date
    {
        return $this->date;
    }

    public function getTime(): Time
    {
        return $this->time;
    }

    public static function now(): DateTime
    {
        return new DateTime(Date::now(), Time::now());
    }

    private static function format(Date $date, Time $time): string
    {
        return "{$date} {$time}";
    }

    public function __toString(): string
    {
        return self::format($this->date, $this->time);
    }

    public static function fromDateTimeInterface(\DateTimeInterface $dateTime): DateTime
    {
        $date = Date::fromDateTimeInterface($dateTime);
        $time = Time::fromDateTimeInterface($dateTime);

        return new DateTime($date, $time);
    }

    public static function fromString(string $dateTimeString, string $format = self::SIMPLE): DateTime
    {
        $dateTime = DateTimeImmutable::createFromFormat($format, $dateTimeString);

        if ($dateTime === false) {
            throw new InvalidDateTime($dateTimeString);
        }

        return static::fromDateTimeInterface($dateTime);
    }
}

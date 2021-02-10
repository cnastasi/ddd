<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Contract\CompositeValueObject;
use Cnastasi\DDD\ValueObject\Primitive\Date;
use Cnastasi\DDD\ValueObject\InvalidDate;
use Cnastasi\DDD\ValueObject\InvalidDateTime;
use Cnastasi\DDD\ValueObject\InvalidTime;
use Cnastasi\DDD\ValueObject\Primitive\Time;

final class DateTime implements CompositeValueObject
{
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
        $time = new Time($dateTime);

        return new DateTime($date, $time);
    }

    public static function fromString(string $dateTimeString): DateTime
    {
        if (! \preg_match(self::DATE_TIME_FORMAT, $dateTimeString)) {
            throw new InvalidDateTime($dateTimeString);
        }

        $parts = \explode(' ', $dateTimeString);

        try {
            return new DateTime(
                Date::fromString($parts[0]),
                new Time($parts[1])
            );
        } catch (InvalidDate | InvalidTime $exception) {
            throw new InvalidDateTime($dateTimeString);
        }
    }
}

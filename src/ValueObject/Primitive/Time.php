<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use CNastasi\DDD\Contract\CompositeValueObject;
use CNastasi\DDD\Contract\Serializable;
use CNastasi\DDD\Error\InvalidDate;
use CNastasi\DDD\Error\InvalidFormat;
use CNastasi\DDD\Error\InvalidTime;
use DateTimeImmutable;
use DateTimeInterface;

final class Time implements CompositeValueObject, Serializable
{
    private const TIME_FORMAT = 'H:i:s';

    private int $hours;

    private int $minutes;

    private int $seconds;

    public function __construct(int $hours, int $minutes, int $seconds)
    {
        $this->assertDateIsValid($hours, $minutes, $seconds);

        $this->hours = $hours;
        $this->minutes = $minutes;
        $this->seconds = $seconds;
    }

    public static function now(): Time
    {
        return Time::fromDateTimeInterface(new DateTimeImmutable());
    }

    private static function toString(int $hours, int $minutes, int $seconds):string {
        return \sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function getHours(): int
    {
        return $this->hours;
    }

    public function getMinutes(): int
    {
        return $this->minutes;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    public function __toString(): string
    {
        return static::toString($this->hours, $this->minutes, $this->seconds);
    }

    public static function fromDateTimeInterface(DateTimeInterface $date): self
    {
        $hours = (int)$date->format('H');
        $minutes = (int)$date->format('i');
        $seconds = (int)$date->format('s');

        return new static($hours, $minutes, $seconds);
    }

    public static function fromString(string $time): Time
    {
        if (!preg_match('/^([0-1]?[0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/', $time, $matches)) {
            throw new InvalidTime($time);
        }

        [, $hours, $minutes, $seconds] = $matches;

        return new Time ((int)$hours, (int)$minutes, (int)$seconds);
    }

    private function assertDateIsValid(int $hours, int $minutes, int $seconds): void
    {
        if (($hours < 0 || $hours > 23) || ($minutes < 0 || $minutes > 59) || ($seconds < 0 || $seconds > 59)) {
            $timeAsString = static::toString($hours, $minutes, $seconds);

            throw new InvalidTime($timeAsString);
        }
    }

    public function serialize()
    {
        return $this->__toString();
    }
}

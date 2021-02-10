<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Contract\SimpleValueObject;
use Cnastasi\DDD\Error\InvalidFormat;
use Cnastasi\DDD\Error\InvalidTime;
use DateTimeImmutable;
use DateTimeInterface;

final class Time implements SimpleValueObject
{
    private const TIME_FORMAT = 'H:i:s';

    private int $hours;

    private int $minutes;

    private int $seconds;

    public function __construct($value)
    {
        $time = ($value instanceof DateTimeInterface)
            ? $this->convertOrFail($value)
            : $this->parseOrFail((string) $value);

        $this->hours = (int) $time->format('H');
        $this->minutes = (int) $time->format('i');
        $this->seconds = (int) $time->format('s');
    }

    public static function now(): Time
    {
        return new Time(new DateTimeImmutable());
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

    public function value(): string
    {
        return \sprintf('%02d:%02d:%02d', $this->hours, $this->minutes, $this->seconds);
    }

    public function __toString(): string
    {
        return $this->value();
    }

    private function parseOrFail(string $value): DateTimeImmutable
    {
        $time = null;

        try {
            $time = DateTimeImmutable::createFromFormat(self::TIME_FORMAT, $value);
        } catch (InvalidFormat $exception) {
            throw new InvalidTime($value);
        }

        if ($time->format(self::TIME_FORMAT) !== $value) {
            throw new InvalidTime($value);
        }

        return $time;
    }

    protected function convertOrFail(DateTimeInterface $value): DateTimeImmutable
    {
        try {
            return $value instanceof DateTimeImmutable
                ? $value
                : DateTimeImmutable::createFromFormat(self::TIME_FORMAT, $value);
        } catch (\Exception $e) {
            throw new InvalidTime($value->format(self::TIME_FORMAT));
        }
    }
}

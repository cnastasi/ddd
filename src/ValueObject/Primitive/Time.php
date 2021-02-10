<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Contract\SimpleValueObject;
use Cnastasi\DDD\Error\InvalidTime;
use Cnastasi\DDD\ValueObject\CarbonImmutable;
use Cnastasi\DDD\ValueObject\InvalidFormatException;
use DateTimeInterface;

final class Time implements SimpleValueObject
{
    private const TIME_FORMAT = 'H:i:s';

    private CarbonImmutable $time;

    private int $hours;

    private int $minutes;

    private int $seconds;

    public function __construct($value)
    {
        $time = ($value instanceof \DateTimeInterface)
            ? $this->convertOrFail($value)
            : $this->parseOrFail((string) $value);

        $this->hours = $time->hour;
        $this->minutes = $time->minute;
        $this->seconds = $time->second;
    }

    public static function now(): Time
    {
        return new Time(CarbonImmutable::now());
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

    private function parseOrFail(string $value): CarbonImmutable
    {
        $time = null;

        try {
            $time = CarbonImmutable::createFromFormat(self::TIME_FORMAT, $value);
        } catch (InvalidFormatException $exception) {
            throw new InvalidTime($value);
        }

        if ($time->format(self::TIME_FORMAT) !== $value) {
            throw new InvalidTime($value);
        }

        return $time;
    }

    protected function convertOrFail(DateTimeInterface $value): CarbonImmutable
    {
        try {
            return ($value instanceof CarbonImmutable) ? $value : CarbonImmutable::instance($value);
        } catch (\Exception $e) {
            throw new InvalidTime($value->format(self::TIME_FORMAT));
        }
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use PHPUnit\Framework\TestCase;

class DateTest extends TestCase
{
    /**
     * @covers \CNastasi\DDD\ValueObject\Primitive\Date::__construct
     */
    public function test_constructor(): void
    {
        $days = 10;
        $months = 4;
        $years = 1999;

        $date = new Date($days, $months, $years);

        self::assertSame($days, $date->getDays());
        self::assertSame($months, $date->getMonths());
        self::assertSame($years, $date->getYears());
    }

    /**
     * @covers \CNastasi\DDD\ValueObject\Primitive\Date::now
     */
    public function test_now(): void
    {
        $now = Date::now();
        $expectedNow = new \DateTimeImmutable();

        $years = (int)$expectedNow->format('Y');
        $months = (int)$expectedNow->format('m');
        $days = (int)$expectedNow->format('d');

        self::assertSame($years, $now->getYears());
        self::assertSame($months, $now->getMonths());
        self::assertSame($days, $now->getDays());
    }
}

<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject\Primitive;

use Cnastasi\DDD\Error\InvalidString;
use PHPUnit\Framework\TestCase;

/**
 * Class TextTest
 * @covers \Cnastasi\DDD\ValueObject\Primitive\Text
 * @package Cnastasi\DDD\ValueObject\Primitive
 */
class TextTest extends TestCase
{
    public function test_constructor(): void
    {
        $text = 'test';
        $myText = new Text($text);

        self::assertSame($text, $myText->value());
    }

    public function test_error(): void
    {
        $this->expectException(InvalidString::class);

        new class ('test') extends Text {
            protected string $pattern = '/^\\.{3}$/';
        };
    }
}

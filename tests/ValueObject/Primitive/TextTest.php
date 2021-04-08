<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject\Primitive;

use stdClass;
use PHPUnit\Framework\TestCase;
use CNastasi\DDD\Error\InvalidString;
use CNastasi\DDD\Error\IncomparableObjects;
use CNastasi\DDD\ValueObject\Primitive\Date;
use CNastasi\DDD\ValueObject\Primitive\Integer;

/**
 * Class TextTest
 * @covers \CNastasi\DDD\ValueObject\Primitive\Text
 * @package CNastasi\DDD\ValueObject\Primitive
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

        /** @psalm-suppress all */
        new class ('test') extends Text {
            protected string $pattern = '/^\\.{3}$/';
        };
    }

    public function test_can_be_compared(): void
    {
        $first = new Text('irrelevant');
        $second = new Text('other-irrelevant');
        $copyOfFirst = new Text('irrelevant');

        /** @psalm-suppress ArgumentTypeCoercion */
        self::assertFalse($first->equalsTo($second));
        /** @psalm-suppress ArgumentTypeCoercion */
        self::assertTrue($first->equalsTo($copyOfFirst));
        /** @psalm-suppress ArgumentTypeCoercion */
        self::assertFalse($second->equalsTo($copyOfFirst));
    }

    public function test_invalid_value_in_comparison_should_throw_exception(): void
    {
        $this->expectException(IncomparableObjects::class);

        $myText = new Text('irrelevant');
        $otherObject = new stdClass();

        /** @psalm-suppress all */
        $myText->equalsTo($otherObject);
    }
}

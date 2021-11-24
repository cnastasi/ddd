<?php

declare(strict_types=1);

namespace CNastasi\DDD;

use CNastasi\DDD\Error\ValidationError;
use ReflectionException;

/**
 * @template T of object
 *
 * @psalm-param class-string<T> $target
 * @param mixed ...$args
 *
 * @return ValidationError|object
 *
 * @throws ReflectionException
 *
 * @psalm-return T|ValidationError
 */
function factory(string $target, ...$args)
{
    $factory = new Factory($target);
    return $factory->make(...$args);
}

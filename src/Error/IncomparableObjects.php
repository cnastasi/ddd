<?php

declare(strict_types=1);

namespace CNastasi\DDD\Error;

class IncomparableObjects extends TypeError
{
    public function __construct(object $objA, object $objB)
    {
        $classA = get_class($objA);
        $classB = get_class($objB);

        parent::__construct("Incomparable objects error: {$classA} is not comparable with {$classB}");
    }
}
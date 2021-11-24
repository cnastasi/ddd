<?php

declare(strict_types=1);

namespace CNastasi\DDD\Primitive;

class PositiveInteger extends Integer
{
    protected int $min = 0;
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

interface Creatable
{
    public function getCreatedAt(): DateTime;
}
<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

interface Updatable
{
    public function getUpdatedAt(): DateTime;

    public function touch(): void;
}
<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

interface Deletable
{
    public function getDeletedAt(): DateTime;

    public function delete(): void;

    public function restore(): void;
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

trait UpdatableTrait
{
    private DateTime $updatedAt;

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function touch(): void
    {
        $this->updatedAt = DateTime::now();
    }
}

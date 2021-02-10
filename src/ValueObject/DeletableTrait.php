<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

trait DeletableTrait
{
    private ?DateTime $deletedAt;

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function delete(): void
    {
        $this->deletedAt = DateTime::now();
    }

    public function restore(): void
    {
        $this->deletedAt = null;
    }
}
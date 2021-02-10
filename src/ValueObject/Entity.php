<?php

declare(strict_types=1);

namespace Cnastasi\DDD\ValueObject;

use Cnastasi\DDD\Contract\CompositeValueObject;

abstract class Entity implements CompositeValueObject
{
    private Id $id;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    private ?DateTime $deletedAt;

    public function __construct(Id $id, DateTime $createdAt, DateTime $updatedAt, ?DateTime $deletedAt)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    public function touch(): void
    {
        $this->updatedAt = DateTime::now();
    }

    public function delete(): void
    {
        $this->deletedAt = DateTime::now();
    }

    public function restore(): void
    {
        $this->deletedAt = null;
    }

    abstract public static function getSerializedName(): string;
}

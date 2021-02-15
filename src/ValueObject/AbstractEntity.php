<?php

declare(strict_types=1);

namespace CNastasi\DDD\ValueObject;

use CNastasi\DDD\Contract\Entity;
use CNastasi\DDD\Contract\Identifier;
use CNastasi\DDD\ValueObject\Primitive\DateTime;

abstract class AbstractEntity implements Entity
{
    private Identifier $id;

    private DateTime $createdAt;

    public function __construct(Identifier $id, DateTime $createdAt)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
    }

    public function getId(): Identifier
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return static
     */
    public static function make(Identifier $id):self {
        return new static ($id, DateTime::now());
    }
}

<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

use CNastasi\DDD\ValueObject\Primitive\DateTime;

interface Entity extends CompositeValueObject
{
    public function getId():Identifier;

    public function getCreatedAt(): DateTime;
}

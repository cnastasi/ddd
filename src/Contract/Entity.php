<?php

declare(strict_types=1);

namespace CNastasi\DDD\Contract;

interface Entity extends CompositeValueObject
{
    public function getId(): Identifier;
}

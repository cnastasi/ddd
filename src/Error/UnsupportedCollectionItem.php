<?php

declare(strict_types=1);

namespace Cnastasi\DDD\Error;

class UnsupportedCollectionItem extends TypeError
{
    public function __construct(string $unsupportedClass, string $supportedClass)
    {
        parent::__construct("Unsupported item class {$unsupportedClass}, {$supportedClass} supported");
    }
}
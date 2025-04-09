<?php

namespace Yuges\Groupable\Exceptions;

use Exception;
use TypeError;
use Yuges\Groupable\Models\Groupable;

class InvalidGroupable extends Exception
{
    public static function doesNotImplementGroupable(string $class): TypeError
    {
        $groupable = Groupable::class;

        return new TypeError("Groupable class `{$class}` must implement `{$groupable}`");
    }
}

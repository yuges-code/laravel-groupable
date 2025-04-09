<?php

namespace Yuges\Groupable\Exceptions;

use Exception;
use TypeError;
use Yuges\Groupable\Models\Group;

class InvalidGroup extends Exception
{
    public static function doesNotImplementGroup(string $class): TypeError
    {
        $group = Group::class;

        return new TypeError("Group class `{$class}` must implement `{$group}`");
    }
}

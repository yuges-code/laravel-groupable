<?php

namespace Yuges\Groupable\Config;

use Yuges\Package\Enums\KeyType;
use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Models\Groupable;
use Yuges\Groupable\Observers\GroupObserver;
use Yuges\Groupable\Observers\GroupableObserver;

class Config extends \Yuges\Package\Config\Config
{
    const string NAME = 'groupable';

    public static function getGroupTable(mixed $default = null): string
    {
        return self::get('models.group.table', $default);
    }

    /** @return class-string<Group> */
    public static function getGroupClass(mixed $default = null): string
    {
        return self::get('model.group.class', $default);
    }

    public static function getGroupKeyType(mixed $default = null): KeyType
    {
        return self::get('models.group.key', $default);
    }

    /** @return class-string<GroupObserver> */
    public static function getGroupObserverClass(mixed $default = null): string
    {
        return self::get('models.group.observer', $default);
    }

    public static function getGroupableTable(mixed $default = null): string
    {
        return self::get('models.groupable.table', $default);
    }

    /** @return class-string<Groupable> */
    public static function getGroupableClass(mixed $default = null): string
    {
        return self::get('models.groupable.class', $default);
    }

    public static function getGroupableKeyType(mixed $default = null): KeyType
    {
        return self::get('models.groupable.key', $default);
    }

    /** @return Collection<array-key, class-string<Groupable>> */
    public static function getGroupableAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.groupable.allowed.classes', $default)
        );
    }

    /** @return class-string<GroupableObserver> */
    public static function getGroupableObserverClass(mixed $default = null): string
    {
        return self::get('models.Groupable.observer', $default);
    }
}

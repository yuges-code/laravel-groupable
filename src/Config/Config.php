<?php

namespace Yuges\Groupable\Config;

use Yuges\Package\Enums\KeyType;
use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Models\Groupable;
use Yuges\Groupable\Interfaces\Grouperator;
use Yuges\Groupable\Observers\GroupObserver;
use Yuges\Groupable\Actions\SyncGroupsAction;
use Yuges\Groupable\Actions\AttachGroupsAction;
use Yuges\Groupable\Actions\DetachGroupsAction;
use Yuges\Groupable\Observers\GroupableObserver;
use Yuges\Groupable\Interfaces\Groupable as GroupableInterface;

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

    public static function getGroupableRelationName(mixed $default = null): string
    {
        return self::get('models.groupable.relation.name', $default);
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
        return self::get('models.groupable.observer', $default);
    }

    public static function getGrouperatorKeyType(mixed $default = null): KeyType
    {
        return self::get('models.grouperator.key', $default);
    }

    public static function getGrouperatorRelationName(mixed $default = null): string
    {
        return self::get('models.grouperator.relation.name', $default);
    }

    /** @return class-string<Grouperator> */
    public static function getGrouperatorDefaultClass(mixed $default = null): string
    {
        return self::get('models.grouperator.default.class', $default);
    }

    /** @return Collection<array-key, class-string<Grouperator>> */
    public static function getGrouperatorAllowedClasses(mixed $default = null): Collection
    {
        return Collection::make(
            self::get('models.grouperator.allowed.classes', $default)
        );
    }

    public static function getPermissionsAnonymous(mixed $default = false): bool
    {
        return self::get('permissions.anonymous', $default);
    }

    public static function getSyncGroupsAction(
        GroupableInterface $groupable,
        mixed $default = null
    ): SyncGroupsAction
    {
        return self::getSyncGroupsActionClass($default)::create($groupable);
    }

    /** @return class-string<SyncGroupsAction> */
    public static function getSyncGroupsActionClass(mixed $default = null): string
    {
        return self::get('actions.sync', $default);
    }

    public static function getAttachGroupsAction(
        GroupableInterface $groupable,
        mixed $default = null
    ): AttachGroupsAction
    {
        return self::getAttachGroupsActionClass($default)::create($groupable);
    }

    /** @return class-string<AttachGroupsAction> */
    public static function getAttachGroupsActionClass(mixed $default = null): string
    {
        return self::get('actions.attach', $default);
    }

    public static function getDetachGroupsAction(
        GroupableInterface $groupable,
        mixed $default = null
    ): DetachGroupsAction
    {
        return self::getDetachGroupsActionClass($default)::create($groupable);
    }

    /** @return class-string<DetachGroupsAction> */
    public static function getDetachGroupsActionClass(mixed $default = null): string
    {
        return self::get('actions.detach', $default);
    }
}

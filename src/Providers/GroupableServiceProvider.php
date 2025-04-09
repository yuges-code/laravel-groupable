<?php

namespace Yuges\Groupable\Providers;

use Yuges\Package\Data\Package;
use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Yuges\Groupable\Models\Groupable;
use Yuges\Groupable\Exceptions\InvalidGroup;
use Yuges\Groupable\Observers\GroupObserver;
use Yuges\Groupable\Observers\GroupableObserver;
use Yuges\Groupable\Exceptions\InvalidGroupable;

class GroupableServiceProvider extends \Yuges\Package\Providers\PackageServiceProvider
{
    protected string $name = 'laravel-groupable';

    public function configure(Package $package): void
    {
        $group = Config::getGroupClass(Group::class);
        $groupable = Config::getGroupableClass(Groupable::class);

        if (! is_a($group, Group::class, true)) {
            throw InvalidGroup::doesNotImplementGroup($group);
        }

        if (! is_a($groupable, Groupable::class, true)) {
            throw InvalidGroupable::doesNotImplementGroupable($groupable);
        }

        $package
            ->hasName($this->name)
            ->hasConfig('groupable')
            ->hasMigrations([
                '000_create_groups_table',
                '001_create_groupables_table',
            ])
            ->hasObserver($group, Config::getGroupObserverClass(GroupObserver::class))
            ->hasObserver($groupable, Config::getGroupableObserverClass(GroupableObserver::class));
    }
}

<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Yuges\Groupable\Models\Groupable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property Collection<array-key, Group> $groups
 */
trait CanGroup
{
    public function groups(): MorphToMany
    {
        /** @var Model $this */
        return $this
            ->morphToMany(
                Config::getGroupClass(Group::class),
                Config::getGroupableRelationName('groupable')
            )
            ->using(Config::getGroupableClass(Groupable::class))
            ->withTimestamps();
    }
}

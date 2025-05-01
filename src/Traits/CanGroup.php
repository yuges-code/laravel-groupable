<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property Collection<array-key, Group> $groups
 */
trait CanGroup
{
    public function groups(): MorphMany
    {
        /** @var Model $this */
        return $this
            ->morphMany(
                Config::getGroupClass(Group::class),
                Config::getGrouperatorRelationName('grouperator')
            );
    }
}

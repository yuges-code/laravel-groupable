<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Config\Config;
use Yuges\Groupable\Models\Groupable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * @property Collection<array-key, Group> $groups
 */
trait HasGroups
{
    public function groups(): MorphToMany
    {
        /** @var Model $this */
        return $this
            ->morphToMany(Config::getGroupClass(Group::class), 'groupable')
            ->using(Config::getGroupableClass(Groupable::class))
            ->withTimestamps();
    }

    public function group(Group $group): static
    {
        return $this->attachGroup($group);
    }

    public function ungroup(Group $group): static
    {
        return $this->detachGroup($group);
    }

    public function attachGroup(Group $group): static
    {
        $this->attachGroups(Collection::make([$group]));

        return $this;
    }

    /**
     * @param Collection<array-key, Group> $groups
     */
    public function attachGroups(Collection $groups): static
    {
        Config::getAttachGroupsAction($this)->execute($groups);

        return $this;
    }

    public function detachGroup(Group $group): static
    {
        $this->detachGroups(Collection::make([$group]));

        return $this;
    }

    /**
     * @param Collection<array-key, Group> $groups
     */
    public function detachGroups(Collection $groups): static
    {
        Config::getDetachGroupsAction($this)->execute($groups);

        return $this;
    }

    /**
     * @param Collection<array-key, Group> $groups
     */
    public function syncGroups(Collection $groups): static
    {
        Config::getSyncGroupsAction($this)->execute($groups);

        return $this;
    }
}

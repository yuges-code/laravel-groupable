<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Config\Config;
use Illuminate\Support\Facades\Auth;
use Yuges\Groupable\Models\Groupable;
use Illuminate\Database\Eloquent\Model;
use Yuges\Groupable\Interfaces\Grouperator;
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
            ->morphToMany(
                Config::getGroupClass(Group::class),
                Config::getGroupableRelationName('groupable')
            )
            ->using(Config::getGroupableClass(Groupable::class))
            ->withTimestamps();
    }

    public function group(Group $group, ?Grouperator $grouperator = null): static
    {
        return $this->attachGroup($group, $grouperator);
    }

    public function ungroup(Group $group): static
    {
        return $this->detachGroup($group);
    }

    public function attachGroup(Group $group, ?Grouperator $grouperator = null): static
    {
        $this->attachGroups(Collection::make([$group]), $grouperator);

        return $this;
    }

    /**
     * @param Collection<array-key, Group> $groups
     */
    public function attachGroups(Collection $groups, ?Grouperator $grouperator = null): static
    {
        Config::getAttachGroupsAction($this)->execute($groups, $grouperator);

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

    public function defaultGrouperator(): ?Grouperator
    {
        /** @var ?Grouperator */
        $grouperator = Auth::user();

        return $grouperator;
    }
}

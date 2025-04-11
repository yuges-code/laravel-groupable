<?php

namespace Yuges\Groupable\Interfaces;

use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface Groupable
{
    public function groups(): MorphToMany;

    public function group(Group $group): static;

    public function ungroup(Group $group): static;

    public function attachGroup(Group $group): static;

    public function attachGroups(Collection $groups): static;

    public function detachGroup(Group $group): static;

    public function detachGroups(Collection $groups): static;

    public function syncGroups(Collection $groups): static;
}

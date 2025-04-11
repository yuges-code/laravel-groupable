<?php

namespace Yuges\Groupable\Actions;

use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Interfaces\Groupable;

class SyncGroupsAction
{
    public function __construct(
        protected Groupable $groupable
    ) {
    }

    public static function create(Groupable $groupable): self
    {
        return new static($groupable);
    }

    /**
     * @param Collection<array-key, Group> $groups
     */
    public function execute(Collection $groups): Groupable
    {
        $ids = $groups
            ->map(function (Group $group) {
                return $group->id;
            })
            ->filter(function (mixed $value) {
                return (bool) $value;
            });

        $this->groupable->groups()->sync($ids);

        return $this->groupable;
    }
}

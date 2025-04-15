<?php

namespace Yuges\Groupable\Actions;

use Yuges\Groupable\Models\Group;
use Illuminate\Support\Collection;
use Yuges\Groupable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Groupable\Interfaces\Groupable;
use Yuges\Groupable\Interfaces\Grouperator;
use Yuges\Groupable\Models\Groupable as GroupableModel;

class AttachGroupsAction
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
    public function execute(Collection $groups, ?Grouperator $grouperator = null): Groupable
    {
        $grouperator ??= $this->groupable->defaultGrouperator();

        $ids = $groups
            ->map(function (Group $group) {
                return $group->id;
            })
            ->filter(function (mixed $value) {
                return (bool) $value;
            });

        $groups = Config::getGroupClass(Group::class)::query()->getQuery()->whereIn('id', $ids)->get();

        $this->groupable->groups()->syncWithPivotValues($groups->pluck('id'), $this->pivotValues($grouperator), false);

        return $this->groupable;
    }

    public function pivotValues(?Grouperator $grouperator = null): array
    {
        $pivot = new GroupableModel();
        $relation = $pivot->grouperator();

        return [
            $relation->getForeignKeyName() => $grouperator instanceof Model ? $grouperator->getKey() : null,
            $relation->getMorphType() => $grouperator instanceof Model ? $grouperator->getMorphClass() : null,
        ];
    }
}

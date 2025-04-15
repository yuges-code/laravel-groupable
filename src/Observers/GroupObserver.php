<?php

namespace Yuges\Groupable\Observers;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;

class GroupObserver
{
    public function creating(Group $group): void
    {
        if ($group->shouldSortWhenCreating()) {
            if (is_null($group->order)) {
                $group->setHighestOrderNumber();
            }
        }
    }

    public function saving(Group $group): void
    {

    }

    public function deleted(Group $group): void
    {

    }
}

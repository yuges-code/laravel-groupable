<?php

namespace Yuges\Groupable\Observers;

use Yuges\Groupable\Models\Groupable;

class GroupableObserver
{
    public function creating(Groupable $groupable): void
    {
        if ($groupable->shouldSortWhenCreating()) {
            if (is_null($groupable->order)) {
                $groupable->setHighestOrderNumber();
            }
        }
    }

    public function saving(Groupable $groupable): void
    {

    }

    public function deleted(Groupable $groupable): void
    {

    }
}

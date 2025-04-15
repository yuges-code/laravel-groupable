<?php

namespace Yuges\Groupable\Observers;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;

class GroupObserver
{
    public function saving(Group $group): void
    {

    }

    public function deleted(Group $group): void
    {

    }
}

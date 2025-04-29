<?php

namespace Yuges\Groupable\Traits;

use Illuminate\Support\Collection;
use Yuges\Groupable\Config\Config;
use Yuges\Groupable\Models\Groupable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection<array-key, Groupable> $groupables
 */
trait HasGroupables
{
    public function groupables(): HasMany
    {
        return $this->hasMany(Config::getGroupableClass(Groupable::class));
    }
}

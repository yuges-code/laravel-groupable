<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property null|int|string $parent_id
 * 
 * @property Collection<array-key, Group> $nested
 * @property Collection<array-key, Group> $groups
 * @property Collection<array-key, Group> $children
 */
trait HasParent
{
    public function nested(): HasMany
    {
        return $this->children();
    }

    public function groups(): HasMany
    {
        return $this->children();
    }

    public function children(): HasMany
    {
        /** @var Model $this */
        return $this->hasMany(Config::getGroupClass(Group::class), 'parent_id');
    }

    public function isParentless(): bool
    {
        return ! $this->parent_id;
    }
}

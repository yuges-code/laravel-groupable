<?php

namespace Yuges\Groupable\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @property integer $order
 */
trait HasOrder
{
    abstract public function getHighestOrderNumber(): int;

    public function setHighestOrderNumber(): void
    {
        $column = $this->determineOrderColumnName();

        $this->$column = $this->getHighestOrderNumber() + 1;
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy($this->determineOrderColumnName());
    }

    protected function determineOrderColumnName(): string
    {
        return 'order';
    }

    public function shouldSortWhenCreating(): bool
    {
        return true;
    }
}

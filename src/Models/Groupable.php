<?php

namespace Yuges\Groupable\Models;

use Yuges\Groupable\Config\Config;
use Yuges\Package\Traits\HasTable;
use Yuges\Groupable\Traits\HasOrder;
use Yuges\Package\Traits\HasTimestamps;
use Yuges\Groupable\Traits\HasGrouperator;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Groupable extends MorphPivot
{
    use HasFactory, HasTable, HasTimestamps, HasGrouperator, HasOrder;

    public $table = 'groupables';

    protected $guarded = [];

    public function getTable(): string
    {
        return Config::getGroupableTable() ?? $this->table;
    }

    public function groupable(): MorphTo
    {
        return $this->morphTo();
    }

    public function getHighestOrderNumber(): int
    {
        return (int) static::query()
            ->where('group_id', $this->group_id)
            ->where('grouperator_id', $this->grouperator_id)
            ->where('grouperator_type', $this->grouperator_type)
            ->max($this->determineOrderColumnName());
    }
}

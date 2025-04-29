<?php

namespace Yuges\Groupable\Models;

use Yuges\Groupable\Config\Config;
use Yuges\Package\Traits\HasTable;
use Yuges\Orderable\Traits\HasOrder;
use Yuges\Package\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Builder;
use Yuges\Orderable\Options\OrderOptions;
use Yuges\Orderable\Interfaces\Orderable;
use Yuges\Groupable\Traits\HasGrouperator;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Groupable extends MorphPivot implements Orderable
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

    public function orderable(): OrderOptions
    {
        $options = new OrderOptions();

        $options->query = fn (Builder $builder) => $builder
            ->where('group_id', $this->group_id)
            ->where('grouperator_id', $this->grouperator_id)
            ->where('grouperator_type', $this->grouperator_type);

        return $options;
    }
}

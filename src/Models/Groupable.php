<?php

namespace Yuges\Groupable\Models;

use Yuges\Groupable\Config\Config;
use Yuges\Package\Traits\HasTable;
use Yuges\Package\Traits\HasTimestamps;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Groupable extends MorphPivot
{
    use HasFactory, HasTable, HasTimestamps;

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
}

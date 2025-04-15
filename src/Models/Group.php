<?php

namespace Yuges\Groupable\Models;

use Yuges\Package\Models\Model;
use Yuges\Groupable\Config\Config;
use Yuges\Sluggable\Traits\HasSlug;
use Yuges\Groupable\Traits\HasOrder;
use Yuges\Groupable\Traits\HasParent;
use Yuges\Sluggable\Options\SlugOptions;
use Yuges\Sluggable\Interfaces\Sluggable;
use Yuges\Groupable\Traits\HasGrouperator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $name
 * @property string $slug
 * @property null|string $type
 */
class Group extends Model implements Sluggable
{
    use HasFactory, HasParent, HasGrouperator, HasSlug, HasOrder;

    protected $table = 'groups';

    protected $guarded = ['id'];

    public function getTable(): string
    {
        return Config::getGroupTable() ?? $this->table;
    }

    public function sluggable(): SlugOptions
    {
        $options = new SlugOptions();

        $options->column = 'slug';
        $options->separator = '-';
        $options->source = ['name'];
        $options->union = [];

        return $options;
    }

    public function getHighestOrderNumber(): int
    {
        return (int) static::query()
            ->where('grouperator_id', $this->grouperator_id)
            ->where('grouperator_type', $this->grouperator_type)
            ->max($this->determineOrderColumnName());
    }
}

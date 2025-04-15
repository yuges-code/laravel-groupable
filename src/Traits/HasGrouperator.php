<?php

namespace Yuges\Groupable\Traits;

use Yuges\Groupable\Config\Config;
use Illuminate\Database\Eloquent\Model;
use Yuges\Groupable\Interfaces\Grouperator;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property ?string $grouperator_type
 * @property null|int|string $grouperator_id
 * 
 * @property ?Grouperator $grouperator
 */
trait HasGrouperator
{
    public function grouperator(): MorphTo
    {
        /** @var Model $this */
        return $this->morphTo(Config::getGrouperatorRelationName('grouperator'));
    }
}

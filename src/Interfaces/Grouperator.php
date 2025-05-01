<?php

namespace Yuges\Groupable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Grouperator
{
    public function groups(): MorphMany;
}

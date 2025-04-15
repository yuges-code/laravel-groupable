<?php

namespace Yuges\Groupable\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

interface Grouperator
{
    public function groups(): MorphToMany;
}

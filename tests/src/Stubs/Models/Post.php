<?php

namespace Yuges\Groupable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Groupable\Interfaces\Groupable;
use Yuges\Groupable\Traits\HasGroups;

class Post extends Model implements Groupable
{
    use HasGroups;

    protected $table = 'posts';

    protected $guarded = ['id'];
}

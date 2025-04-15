<?php

namespace Yuges\Groupable\Tests\Stubs\Models;

use Yuges\Package\Models\Model;
use Yuges\Groupable\Interfaces\Grouperator;
use Yuges\Groupable\Traits\CanGroup;

class User extends Model implements Grouperator
{
    use CanGroup;

    protected $table = 'users';

    protected $guarded = ['id'];
}

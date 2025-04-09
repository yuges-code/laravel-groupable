<?php

namespace Yuges\Groupable\Tests\Feature;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Tests\TestCase;
use Yuges\Groupable\Models\Groupable;
use Yuges\Groupable\Tests\Stubs\Models\User;

class HasTableTest extends TestCase
{
    public function testGettingTableName()
    {
        $this->assertEquals('users', User::getTableName());
        $this->assertEquals('groups', Group::getTableName());
        $this->assertEquals('groupables', Groupable::getTableName());
    }
}

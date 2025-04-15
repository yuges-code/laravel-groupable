<?php

namespace Yuges\Groupable\Tests\Integration;

use Yuges\Groupable\Models\Group;
use Yuges\Groupable\Tests\TestCase;
use Yuges\Groupable\Models\Groupable;
use Yuges\Groupable\Tests\Stubs\Models\User;
use Yuges\Groupable\Tests\Stubs\Models\Post;

class GroupTest extends TestCase
{
    public function testGroupPosts()
    {
        config(['groupable.models.grouperator.allowed.classes' => [User::class]]);

        $user = User::query()->create([
            'name' => 'Georgy',
            'email' => 'goshasafonov@yandex.ru',
            'password' => 'test',
        ]);

        $post = Post::query()->create([
            'title' => 'Post',
        ]);

        $group = new Group([
            'name' => 'Group',
        ]);

        $group->grouperator()->associate($user)->save();

        $post->group($group, $user);

        $this->assertDatabaseHas(Groupable::getTableName(), [
            'groupable_id' => $post->getKey(),
            'groupable_type' => $post->getMorphClass(),
            'grouperator_id' => $user->getKey(),
            'grouperator_type' => $user->getMorphClass(),
        ]);
    }
}

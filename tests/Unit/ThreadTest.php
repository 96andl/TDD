<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_thread_can_create_reply() {
        $thread = factory(Thread::class)->create();

        $thread->addReply([
            'body' => 'Foo',
            'user_id' => $this->not_auth_user->id,
            'thread_id' => $thread->id
        ]);

        $this->assertCount(1,$thread->replies);
    }

    public function testThreadCanMakeStringPath() {
        $thread = create(Thread::class);

        $this->assertEquals("/threads/{$thread->channel->slug }/{$thread->id}", $thread->path);
    }
}

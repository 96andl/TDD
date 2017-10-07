<?php

    namespace Tests\Unit;

    use App\Reply;
    use App\Thread;
    use App\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\DatabaseMigrations;

    class ReplyTest extends TestCase
    {
        use DatabaseMigrations;

        function test_it_has_an_owner()
        {
            $reply = factory(Reply::class)->create();

            $this->assertInstanceOf(User::class, $reply->owner);
        }

        public function test_a_thread_have_a_creator()
        {
            $thread = factory(Thread::class)->create();

            $this->assertInstanceOf(User::class, $thread->creator);
        }

        public function aReplyRequiresABody() {
            $reply = make(Reply::class, [
               'body' => null
            ]);

            $response = $this->post("/threads/{$reply->threads->id}/replies");

            $response->assertSessionHasErrors('body');

        }
    }

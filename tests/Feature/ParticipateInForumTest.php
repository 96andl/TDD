<?php

    namespace Tests\Feature;

    use App\Reply;
    use App\Thread;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\DatabaseMigrations;

    class ParticipateInForum extends TestCase
    {
        use DatabaseMigrations;

        public function test_a_user_can_participate_in_forum() {


            $thread = factory(Thread::class)->create(['user_id' => $this->auth_user->id]);
            $reply = factory(Reply::class)->create([
                'user_id' => $this->not_auth_user->id,
                'thread_id' => $thread->id
            ]);

            $this->post('/threads/'.$thread->channel->slug.'/'.$thread->id.'/replies',
                [
                 'body' => $reply->body,
                 'user_id' => $reply->user_id
                ]);


            $response = $this->get('/threads/'.$thread->channel->slug.'/'.$thread->id);

            $response->assertSee($reply->body);

        }

    }

<?php

    namespace Tests\Feature;

    use App\Thread;
    use App\User;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\DatabaseMigrations;

    class CreateThreadTest extends TestCase
    {
        use DatabaseMigrations;


        function testCreateThread()
        {

            $this->be(create(User::class));
            $thread = create(Thread::class);


            $response = $this->post('/threads/'.$thread->channel->id.'/replies', $thread->toArray());

            $response = $this->get($thread->path);

            $response->assertSee($thread->body);
            $response->assertSee($thread->title);

        }
    }

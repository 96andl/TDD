<?php

    namespace Tests\Feature;

    use App\Channel;
    use App\Reply;
    use App\Thread;
    use App\User;
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\URL;
    use Tests\TestCase;
    use Illuminate\Foundation\Testing\RefreshDatabase;

    class ThreadsTest extends TestCase
    {
        static $thread;
        use DatabaseMigrations;

        public function setUp()
        {
            parent::setUp();
            static::$thread = factory(Thread::class)->create();

        }

        public function test_a_user_can_browse_threads()
        {

            $this->actingAs(factory(User::class)->create());
            $response = $this->get('/threads');
            $response->assertStatus(200);
            $response->assertSee(static::$thread->title);
            $response->assertViewHas('threads');
            $response->assertViewIs('threads.index');

            $response = $this->get('/threads/' . static::$thread->channel->slug . '/' . static::$thread->id);

            $response->assertSee(static::$thread->title);

        }

        public function test_a_user_can_view_single_thread()
        {
            $response = $this->get('/threads/' . static::$thread->channel->slug . '/' . static::$thread->id);
            $response->assertSee(static::$thread->title);
        }

        public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
        {
            $reply = factory(Reply::class)
                ->create(['thread_id' => static::$thread->id]);

            $response = $this->get('/threads/' . static::$thread->channel->slug . '/' . static::$thread->id);
            $response->assertSee($reply->body);
        }

        public function test_has_instance_of_channel()
        {
            $thread = factory(Thread::class)->create();
            $this->assertInstanceOf('App\Channel', $thread->channel);
        }

        public function test_a_user_can_filter_threads_according_to_a_tag()
        {
            $channel = create(Channel::class);
            $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
            $threadNotInChannel = create(Thread::class);
            $this->get("/threads/{$channel->slug}")->assertSee($threadInChannel->title)->assertDontSee($threadNotInChannel->title);
        }

        public function testAUserCanFilterThreadByName()
        {
            $auth_user = factory(User::class)->create([
                'name' => 'JohnDoe',
            ]);
            $this->actingAs($auth_user);

            $threadByJohnDoe = create(Thread::class, ['user_id' => $auth_user->id]);
            $threadNotByJohnDoe = create(Thread::class);

            $this->get('/threads?by=JohnDoe')->assertSee($threadByJohnDoe->title)->assertDontSee($threadNotByJohnDoe->title);
        }
    }

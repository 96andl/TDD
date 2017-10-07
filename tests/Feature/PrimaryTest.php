<?php

namespace Tests\Feature;

use App\Channel;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PrimaryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $this->assertTrue(true);
    }

    public function test_channel_visible_on_all_page() {
        $channel = create(Channel::class);
        $response = $this->get('/threads');
        $response->assertSee($channel->name)->assertSee('/threads/'.$channel->slug);

    }
}

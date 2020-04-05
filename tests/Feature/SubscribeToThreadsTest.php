<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscribeToThreadsTest extends TestCase
{
    /** @test */
    public function a_user_can_subscribe_to_thread()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->post($thread->path() . '/subscriptions');

        $thread->addReply([
            'user_id' => auth()->id,
            'body' => 'new',
        ]);

        $this->assertCount(1, $thread->subscriptions);
    }
}
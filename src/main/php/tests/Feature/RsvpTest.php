<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class RsvpTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSendRsvp()
    {
        $user = User::find(1);
        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->post('/rsvp/send/1');
        $response->assertStatus(200);
    }
}

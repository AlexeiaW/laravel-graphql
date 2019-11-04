<?php

namespace Tests\Feature;

use App\User;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\WithFaker;
use Notification;
use Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

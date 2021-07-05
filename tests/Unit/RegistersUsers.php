<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterApiTest extends TestCase
{
  use RefreshDatabase;

  /**
   * @test
   */
  public function should_新しいユーザーを作成して返却する()
  {
    $data = [
      'email' => 'dummy@email.com',
      'password' => 'test1234',
    ];

    $response = $this->json('POST', route('register'), $data);

    $user = User::first();
    $this->assertEquals($data['email'], $user->email);

    $response->assertStatus(201);
  }
}

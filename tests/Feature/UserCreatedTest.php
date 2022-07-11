<?php

namespace Tests\Feature;

use App\Events\UserCreated;
use App\Listeners\SendingEmail;
use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserCreatedTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setup() : void 
    {
        parent::setUp();
        $this->seed(RolesSeeder::class);
    }
    /** @test */
    public function create_user_successfully()
    {
        Event::fake();
        $data = User::factory()->make()->toArray();
        $data['roles'] = [1,2];
        $response = $this->postJson(route('users.store'), $data);
        $response->assertCreated();
        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => 1,
            'model_id'=> 1
        ]);
        $this->assertDatabaseHas('users', [
            'name' => $data['name'],
            'email'=> $data['email']
        ]);
        Event::assertDispatched(UserCreated::class);
        Event::assertListening(
            UserCreated::class,
            SendingEmail::class
        );
    }

    /** @test */
    public function create_user_failed_by_validation_errors()
    {
        Event::fake();
        $data = User::factory()->make(['name' => ''])->toArray();
        $data['roles'] = [1, 2];
        $response = $this->postJson(route('users.store'), $data , ['Accept' => 'application/json']);
        $response->assertJsonValidationErrors('name');
        $response->assertStatus(422);    }
}
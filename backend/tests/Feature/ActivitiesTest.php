<?php

namespace Tests\Feature;

use App\Models\Activity;
use App\Models\User;
use Database\Factories\ActivityFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivitiesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_all_activites()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $this->get('/api/activities')
                ->assertStatus(200);
    }

    public function test_user_can_create_activity()
    {
        $user = User::factory()->create();
        $activity = Activity::factory()->make();
        $this->actingAs($user)
            ->post('api/activities', $activity->toArray())
            ->assertStatus(201)
            ->assertSee($activity->title);
        $this->assertDatabaseHas('activities', $activity->toArray());
    }

    public function test_user_can_see_activity()
    {
        $user = User::factory()->create();
        $activity= $user->activities()->create(Activity::factory()->make()->toArray());
        $this->actingAs($user)
            ->get('api/activities/'.$activity->id)
            ->assertStatus(200)
            ->assertSee($activity->title);
    }
    public function test_user_can_update_activity()
    {
        $user = User::factory()->create();
        $activity = $user->activities()->create(Activity::factory()->make()->toArray());
        $newTitle= 'test title 1';
        $this->actingAs($user)
            ->patch('api/activities/'.$activity->id, ['title'=>$newTitle])
            ->assertStatus(200)
            ->assertSee($newTitle);
    }
    public function test_user_can_delete_his_activities()
    {
        $user = User::factory()->create();
        $activity = $user->activities()->create(Activity::factory()->make()->toArray());
        $this->withoutExceptionHandling();
        
        $this->actingAs($user)
            ->delete($activity->path())
            ->assertStatus(204);
    }
}

<?php

namespace Tests\Feature;

use App\Http\Resources\ActivityResource;
use App\Models\Goal;
use App\Models\TherapyCase;
use App\Models\User;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Routing\Middleware\ThrottleRequests;

class TherapyCaseGoalActivityTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_activities_connected_to_his_case_goals_only()
    {
        Artisan::call('db:seed');
        $user = User::find(1);
        $this->actingAs($user);
        foreach (TherapyCase::all() as $case) {
            foreach ($case->goals as $goal) {
                if ($goal->therapyCase->users->contains('id', $user->id)) {
                    $this->get($goal->path().'/activities')
                        ->assertStatus(200)
                        ->assertSee(ActivityResource::collection($goal->activities)->toJson(), false);
                } else {
                    $this->withoutMiddleware(ThrottleRequests::class)
                        ->get($goal->path().'/activities')
                        ->assertStatus(403);
                }
            }
        }
    }
    public function test_user_can_add_activity_to_case_goal()
    {
        Artisan::call('db:seed');
        $user = User::find(1);
        $goal = $user->therapyCases->first()->goals->first();
        $activity = Activity::inRandomOrder()->first();
        $this->actingAs($user)
            ->patch($goal->path().'/activities/'.$activity->id)
            ->assertStatus(200)
            ->assertSee($activity->title);
    }
    public function test_user_can_detach_activity_from_goal()
    {
        Artisan::call('db:seed');
        $user = User::find(2);
        $goal = $user->therapyCases->first()->goals->first();
        $activity = $goal->activities->first();
        $this->actingAs($user)
            ->delete($activity->nestedPath($goal))
            ->assertStatus(204);
        $resp=$this->get($goal->path().'/activities/')
            ->assertDontSee($activity->title);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Goal;
use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GoalsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_his_therapy_goals()
    {
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
        $case2 = TherapyCase::factory()->has(Goal::factory()->times(10))->create();
        $case->goals()->saveMany(Goal::factory()->times(10)->make());
       
        $this->actingAs($user)
            ->get($case->path().'/goals')
            ->assertStatus(200);
        $this->actingAs($user)
            ->get($case2->path().'/goals')
            ->assertStatus(403);
    }

    public function test_user_can_see_individual_goal()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
        $goal = $case->goals->first();
   
        $this->actingAS($user)
              ->get($goal->path())
              ->assertStatus(200)
              ->assertSee($goal->title);
    }
    public function test_user_cant_see_others_goal()
    {
        $user = User::factory()->create();
        $case = TherapyCase::factory()->has(Goal::factory())->create();
        $goal = $case->goals->first();

        $this->actingAs($user)
            ->get($goal->path())
            ->assertStatus(403);
    }

    public function test_user_can_update_only_his_goals()
    {
        $user = $this->createUserAndCase();
        $goal = $user->therapyCases->first()->goals->first();
        $user2 = User::factory()->create();
        
        $this->actingAs($user2)
            ->patch($goal->path(), ['title' => 'yeet'])
            ->assertStatus(403);
        
        $this->actingAs($user)
            ->patch($goal->path(), ['title' => 'yeet'])
            ->assertStatus(200)
            ->assertSee('yeet');
    }

    public function test_user_can_create_goal()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
        $goal = Goal::factory()->make([
            'title' => 'yeet'
        ]);
        $this->actingAs($user)
            ->post($case->path().'/goals', $goal->toArray())
            ->assertStatus(201);
        $this->assertDatabaseHas('goals', $goal->toArray());
    }

    public function test_user_can_delete_his_goals()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUserAndCase();
        $goal = $user->therapyCases->first()->goals->first();

        $this->actingAs($user)
            ->delete($goal->path())
            ->assertStatus(204);
    }

    public function test_user_cant_access_a_goal_from_another_case()
    {
        $user = $this->createUserAndCase();
        $case1 = $user->therapyCases->first();
        $case2 = TherapyCase::factory()->has(Goal::factory()->times(10))->create();
        $user->therapyCases()->attach($case2);

        $resp = $this->actingAs($user)
            ->get($case1->path().'/goals/'.$case2->goals->first()->id)
            ->assertStatus(403);
    }
}

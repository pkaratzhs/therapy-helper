<?php

namespace Tests\Feature;

use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TherapyCaseTest extends TestCase
{
    use RefreshDatabase;
    /* * @test */
    public function test_a_user_can_see_cases()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $case = TherapyCase::factory()->create();
        $case->users()->attach($user);
        $this->get('api/cases')->assertSee($case->name);
    }

    public function test_a_user_can_create_case()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $case = TherapyCase::factory()->make();
    
        $this->actingAs($user);
        $this->post('api/cases', $case->toArray())
            ->assertStatus(201);
        $this->assertDatabaseHas('therapy_cases', $case->toArray());
    }
    
    public function test_a_user_cant_see_other_cases()
    {
        $user = User::factory()->create();
        $case1 = TherapyCase::factory()->create();
        $case2 = TherapyCase::factory()->create();
        $case2->users()->attach($user);
    
        $this->actingAs($user)
            ->get('api/cases')
            ->assertDontSee($case1->name)
            ->assertSee($case2->name);
    }

    public function test_a_user_can_update_his_case()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $case = TherapyCase::factory()->create();
        $case->users()->attach($user);

        $response = $this->actingAs($user)
            ->patch($case->path(), ['name' => 'little yeeter 2'])
            ->assertStatus(200)
            ->assertSee('little yeeter 2');
    }
    public function test_a_user_can_delete_his_cases()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $case = TherapyCase::factory()->create();
        $case->users()->attach($user);

        $this->actingAs($user)
            ->delete($case->path())
            ->assertStatus(200)
            ->assertSee('deleted');
    }
}

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
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
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
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
        $case2 = TherapyCase::factory()->create();
    
        $this->actingAs($user)
             ->get('api/cases')
             ->assertDontSee($case2->name)
             ->assertSee($case->name);
    }

    public function test_a_user_can_update_his_case()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();

        $response = $this->actingAs($user)
            ->patch($case->path(), ['name' => 'little yeeter 2'])
            ->assertStatus(200)
            ->assertSee('little yeeter 2');
    }
    public function test_a_user_can_delete_his_cases()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUserAndCase();
        $case = $user->therapyCases->first();
        $this->actingAs($user)
            ->delete($case->path())
            ->assertStatus(200)
            ->assertSee('deleted');
    }
}

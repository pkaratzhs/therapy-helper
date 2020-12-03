<?php

namespace Tests\Feature;

use App\Models\Child;
use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Generator as Faker;

class TherapyCaseTest extends TestCase
{
    use RefreshDatabase;
    /* * @test */
    public function test_a_user_can_see_cases()
    {
        $user = User::factory()->create();
        $child = Child::factory()->create();
        $case= TherapyCase::factory([
            'child_id'=> $child
            ])->create();
        $case->users()->attach($user);
        //create a case
        $response = $this->actingAs($user)
            ->get('/api/cases')
            ->assertStatus(200)
            ->assertSee($child->name)
            ->assertSee($user->name);
    }

    public function test_a_user_can_create_case()
    {
        $this->withoutExceptionHandling();

        $faker = \Faker\Factory::create();
        $user=  User::factory()->create();
        $child = Child::factory()->create();
        $case = ['child_id' => $child->id,
                'diagnosis' => $faker->sentence(),
                'finished' => false];
        $this->actingAs($user)
            ->post('/api/cases', $case)
            ->assertSee('users');
        $this->assertDatabaseHas('therapy_cases', $case);
    }
}

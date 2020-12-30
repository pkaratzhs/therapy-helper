<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Goal;
use \App\Models\Activity;
use \App\Models\User;
use \App\Models\TherapyCase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TherapyCase::factory()
            ->times(20)
            ->has(Goal::factory()->times(5))
            ->create()
            ->each(function (TherapyCase $case) {
                $case->users()->attach(User::factory()->create());
            });
       
        $users = User::all();

        foreach ($users as $user) {
            $user->activities()->saveMany(Activity::factory()->times(2)->make());
        }

        $goals = Goal::all();
        $activities = Activity::all();
        foreach ($goals as $goal) {
            $goal->activities()->attach($activities->random(3));
        }
    }
}

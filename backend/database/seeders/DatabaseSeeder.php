<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Goal;
use \App\Models\Child;
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
        Child::factory()
            ->times(10)
            ->has(TherapyCase::factory()
                ->times(2)->has(Goal::factory()->times(3)->has(Activity::factory()->times(5))))
            ->create();
            
        $cases = TherapyCase::all();
        $cases->each(function (TherapyCase $case) {
            $users= User::factory()->times(2)->create();
            $case->users()->attach($users);
        });
    }
}

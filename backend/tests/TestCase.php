<?php

namespace Tests;

use App\Models\Goal;
use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createUserAndCase()
    {
        $user = User::factory()->create();
        $case = TherapyCase::factory()->has(Goal::factory()->times(10))->create();
        $user->therapyCases()->attach($case);

        return $user;
    }
}

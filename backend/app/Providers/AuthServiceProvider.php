<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\TherapyCase' => 'App\Policies\TherapyCasePolicy',
        'App\Models\Goal' => 'App\Policies\GoalPolicy',
        'App\Models\Activity' => 'App\Policies\ActivityPolicy',
        'App\Models\GoalActivity' => 'App\Policies\GoalActivityPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}

<?php

namespace App\Policies;

use App\Models\Activity;
use App\Models\Goal;
use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id === auth()->user()->id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function view(User $user, Activity $activity)
    {
        return $user->id === auth()->user()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id === auth()->user()->id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function update(User $user, Activity $activity)
    {
        return $user->id === $activity->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->id === $activity->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function restore(User $user, Activity $activity)
    {
        return $user->id === $activity->user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Activity  $activity
     * @return mixed
     */
    public function forceDelete(User $user, Activity $activity)
    {
        return $user->id === $activity->user->id;
    }

    public function viewNestedActivity(User $user, Activity $activity, Goal $goal, TherapyCase $case)
    {
        return $activity->goals->contains($goal) && $case->users->contains('id', $user->id);
    }

    public function storeGoalActivity(User $user, Goal $goal, TherapyCase $case)
    {
        return $case->users->contains('id', $user->id) && $case->goals->contains($goal);
    }
    public function deleteGoalActivity(User $user, Activity $activity, Goal $goal, TherapyCase $case)
    {
        return $activity->goals->contains($goal) && $case->users->contains('id', $user->id);
    }
    public function viewAnyActivityOfGoal(User $user, TherapyCase $case, Goal $goal)
    {
        return $case->users->contains('id', $user->id) && $case->goals->contains($goal);
    }
}

<?php

namespace App\Policies;

use App\Models\TherapyCase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TherapyCasePolicy
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
     * @param  \App\Models\TherapyCase  $case
     * @return mixed
     */
    public function view(User $user, TherapyCase $case)
    {
        return $case->users->contains('id', $user->id);
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
     * @param  \App\Models\TherapyCase  $case
     * @return mixed
     */
    public function update(User $user, TherapyCase $case)
    {
        return $case->users->contains('id', $user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TherapyCase  $case
     * @return mixed
     */
    public function delete(User $user, TherapyCase $case)
    {
        return $case->users->contains('id', $user->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TherapyCase  $case
     * @return mixed
     */
    public function restore(User $user, TherapyCase $case)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\TherapyCase  $case
     * @return mixed
     */
    public function forceDelete(User $user, TherapyCase $case)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\User;
use App\Recurring;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecurringPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any recurrings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the recurring.
     *
     * @param  \App\User  $user
     * @param  \App\Recurring  $recurring
     * @return mixed
     */
    public function view(User $user, Recurring $recurring)
    {
        //
    }

    /**
     * Determine whether the user can create recurrings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the recurring.
     *
     * @param  \App\User  $user
     * @param  \App\Recurring  $recurring
     * @return mixed
     */
    public function update(User $user, Recurring $recurring)
    {
        return $user->id == $recurring->owner_id;
    }

    /**
     * Determine whether the user can delete the recurring.
     *
     * @param  \App\User  $user
     * @param  \App\Recurring  $recurring
     * @return mixed
     */
    public function delete(User $user, Recurring $recurring)
    {
        //
    }

    /**
     * Determine whether the user can restore the recurring.
     *
     * @param  \App\User  $user
     * @param  \App\Recurring  $recurring
     * @return mixed
     */
    public function restore(User $user, Recurring $recurring)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the recurring.
     *
     * @param  \App\User  $user
     * @param  \App\Recurring  $recurring
     * @return mixed
     */
    public function forceDelete(User $user, Recurring $recurring)
    {
        //
    }
}

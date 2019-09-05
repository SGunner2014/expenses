<?php

namespace App\Policies;

use App\User;
use App\Week;
use Illuminate\Auth\Access\HandlesAuthorization;

class WeekPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any weeks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the week.
     *
     * @param  \App\User  $user
     * @param  \App\Week  $week
     * @return mixed
     */
    public function view(User $user, Week $week)
    {
        //
    }

    /**
     * Determine whether the user can create weeks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the week.
     *
     * @param  \App\User  $user
     * @param  \App\Week  $week
     * @return mixed
     */
    public function update(User $user, Week $week)
    {
        return $user->id == $week->owner_id;
    }

    /**
     * Determine whether the user can delete the week.
     *
     * @param  \App\User  $user
     * @param  \App\Week  $week
     * @return mixed
     */
    public function delete(User $user, Week $week)
    {
        //
    }

    /**
     * Determine whether the user can restore the week.
     *
     * @param  \App\User  $user
     * @param  \App\Week  $week
     * @return mixed
     */
    public function restore(User $user, Week $week)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the week.
     *
     * @param  \App\User  $user
     * @param  \App\Week  $week
     * @return mixed
     */
    public function forceDelete(User $user, Week $week)
    {
        //
    }
}

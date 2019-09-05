<?php

namespace App\Policies;

use App\User;
use App\Year;
use Illuminate\Auth\Access\HandlesAuthorization;

class YearPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any years.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the year.
     *
     * @param  \App\User  $user
     * @param  \App\Year  $year
     * @return mixed
     */
    public function view(User $user, Year $year)
    {
        //
    }

    /**
     * Determine whether the user can create years.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the year.
     *
     * @param  \App\User  $user
     * @param  \App\Year  $year
     * @return mixed
     */
    public function update(User $user, Year $year)
    {
        return $user->id == $year->owner_id;
    }

    /**
     * Determine whether the user can delete the year.
     *
     * @param  \App\User  $user
     * @param  \App\Year  $year
     * @return mixed
     */
    public function delete(User $user, Year $year)
    {
        //
    }

    /**
     * Determine whether the user can restore the year.
     *
     * @param  \App\User  $user
     * @param  \App\Year  $year
     * @return mixed
     */
    public function restore(User $user, Year $year)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the year.
     *
     * @param  \App\User  $user
     * @param  \App\Year  $year
     * @return mixed
     */
    public function forceDelete(User $user, Year $year)
    {
        //
    }
}

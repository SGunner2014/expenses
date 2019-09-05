<?php

namespace App\Policies;

use App\User;
use App\Child;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the child.
     *
     * @param  \App\User  $user
     * @param  \App\Child  $child
     * @return mixed
     */
    public function update(User $user, Child $child)
    {
        return $user->id == $child->owner_id;
    }
}

<?php

namespace App\Policies;

use App\Models\Policy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Invitation;

class InvitationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Policy $policy)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Policy $policy)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invitation $invitation)
    {
        return $user->id == $invitation->sender_id;
    }

    public function resend(User $user, Invitation $invitation)
    {
        return $user->id == $invitation->sender_id;
    }


    public function respond(User $user, Invitation $invitation)
    {
        return $user->email == $invitation->recipient_email;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Policy $policy)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Policy $policy)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\User;
use App\Venue;
use Illuminate\Auth\Access\HandlesAuthorization;

class VenuePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the venue.
     *
     * @param  \App\User  $user
     * @param  \App\Venue  $venue
     * @return mixed
     */
    public function view(User $user, Venue $venue)
    {
        return $venue->owner === $user->id;
    }

    /**
     * Determine whether the user can create venues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->type, ['event_planner', 'venue_coordinator']);
    }

    /**
     * Determine whether the user can update the venue.
     *
     * @param  \App\User  $user
     * @param  \App\Venue  $venue
     * @return mixed
     */
    public function update(User $user, Venue $venue)
    {
        return $venue->owner === $user->id;
    }

    /**
     * Determine whether the user can delete the venue.
     *
     * @param  \App\User  $user
     * @param  \App\Venue  $venue
     * @return mixed
     */
    public function delete(User $user, Venue $venue)
    {
        //
    }
}

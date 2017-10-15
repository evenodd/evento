<?php

namespace App\Policies;

use App\User;
use App\Evento;
use App\Venue;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function view(User $user, Evento $evento)
    {
        return $user->id === $evento->event_planner; // So who can and cant view events again???
    }

    /**
     * Determines whether a user is allowed to view a summary of the event details
     * Intended to grant venue coordinators permissions to view certain fields
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @param  \App\Venue  $venue
     * @return mixed

     */ 
    public function viewSummary(User $user, Evento $evento, Venue $venue) {
        return 
            $this->view($user, $evento) ||
            $venue->owner === $user->id && $evento->venue === $venue->id;
    }

    /**
     * Determine whether the user can create eventos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->type === 'event_planner';
    }

    /**
     * Determine whether the user can update the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function update(User $user, Evento $evento)
    {
        return $user->id === $evento->event_planner;
    }

    /**
     * Determine whether the user can delete the evento.
     *
     * @param  \App\User  $user
     * @param  \App\Evento  $evento
     * @return mixed
     */
    public function delete(User $user, Evento $evento)
    {
        return $user->id === $evento->event_planner;
    }
}
